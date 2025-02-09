<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        try {
            $carts = auth()->user()->carts()
                ->where('selected', true)
                ->with('product')
                ->get();

            $addresses = auth()->user()->addresses;

            if ($carts->isEmpty()) {
                return redirect()->route('customer.cart')->with('error', 'Please select items to checkout');
            }

            $total = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            if ($total <= 0) {
                return redirect()->route('customer.cart')->with('error', 'Invalid total amount');
            }

            $items = [];
            foreach ($carts as $cart) {
                $items[] = [
                    'id' => $cart->product_id,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                    'name' => $cart->product->name
                ];
            }

            $orderId = 'ORD-' . time() . '-' . auth()->id();

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $total,
                ],
                'item_details' => $items,
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => $addresses->first()->phone_number ?? '',
                    'shipping_address' => [
                        'first_name' => $addresses->first()->recipient_name ?? '',
                        'phone' => $addresses->first()->phone_number ?? '',
                        'address' => $addresses->first()->address ?? '',
                        'city' => $addresses->first()->city ?? '',
                        'postal_code' => $addresses->first()->postal_code ?? '',
                    ]
                ]
            ];

            $snapToken = Snap::getSnapToken($params);

            return view('customer.checkout.index', compact('carts', 'addresses', 'snapToken', 'total'));
        } catch (\Exception $e) {
            Log::error('Checkout Index Error: ' . $e->getMessage());
            return redirect()->route('customer.cart')->with('error', 'Failed to initialize checkout. Please try again.');
        }
    }

    public function process(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'address_id' => 'required|exists:addresses,id'
            ]);

            $carts = auth()->user()->carts()
                ->where('selected', true)
                ->with('product')
                ->get();

            if ($carts->isEmpty()) {
                throw new \Exception('No items in cart');
            }

            $total = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $request->address_id,
                'total_amount' => $total,
                'payment_status' => 'pending',
                'order_number' => 'ORD-' . time() . '-' . auth()->id(),
            ]);

            Log::info('Order created: ' . $order->order_number);

            // Create order items
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price
                ]);
            }

            // Prepare Midtrans params
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $total,
                ],
                'item_details' => $carts->map(function ($cart) {
                    return [
                        'id' => $cart->product_id,
                        'price' => $cart->product->price,
                        'quantity' => $cart->quantity,
                        'name' => $cart->product->name
                    ];
                })->toArray(),
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => $order->address->phone_number,
                    'shipping_address' => [
                        'first_name' => $order->address->recipient_name,
                        'phone' => $order->address->phone_number,
                        'address' => $order->address->address,
                        'city' => $order->address->city,
                        'postal_code' => $order->address->postal_code,
                    ]
                ]
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);

            // Clear cart
            $carts->each->delete();

            DB::commit();

            return redirect()->route('orders');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout Process Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());


            return redirect()->back()
                ->with('error', 'Failed to process order. Please try again.');
        }
    }

    public function notification(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();

            $order = Order::where('order_number', $notification->order_id)->firstOrFail();

            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $fraud = $notification->fraud_status;

            Log::info('Payment Notification', [
                'order_id' => $notification->order_id,
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'fraud_status' => $fraud
            ]);

            DB::beginTransaction();

            $order->payment_type = $type;

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $order->payment_status = 'challenge';
                        $order->status = 'pending';
                    } else {
                        $order->payment_status = 'success';
                        $order->status = 'processing';
                    }
                }
            } else if ($transaction == 'settlement') {
                $order->payment_status = 'success';
                $order->status = 'processing';
            } else if ($transaction == 'pending') {
                $order->payment_status = 'pending';
                $order->status = 'pending';
            } else if ($transaction == 'deny') {
                $order->payment_status = 'failed';
                $order->status = 'cancelled';
            } else if ($transaction == 'expire') {
                $order->payment_status = 'expired';
                $order->status = 'cancelled';
            } else if ($transaction == 'cancel') {
                $order->payment_status = 'failed';
                $order->status = 'cancelled';
            }

            $order->save();

            DB::commit();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Payment Notification Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Payment notification failed'
            ], 500);
        }
    }
}
