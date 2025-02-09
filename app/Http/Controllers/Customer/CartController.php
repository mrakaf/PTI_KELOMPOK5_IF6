<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('product')->get();
        $subtotal = $carts->where('selected', true)->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        
        return view('customer.cart.index', compact('carts', 'subtotal'));
    }

    public function add(Product $product)
    {
        try {
            // Cek apakah produk sudah ada di cart
            $existingCart = Cart::where('user_id', auth()->id())
                              ->where('product_id', $product->id)
                              ->first();

            if ($existingCart) {
                $existingCart->increment('quantity');
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => 1
                ]);
            }

            $cartCount = auth()->user()->carts()->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'cartCount' => $cartCount
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart'
            ], 500);
        }
    }

    public function update(Request $request, Cart $cart)
    {
        try {
            // Validasi request
            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            // Update quantity
            $cart->update([
                'quantity' => $request->quantity
            ]);

            // Hitung total cart
            $cartTotal = auth()->user()->carts->sum(function($cart) {
                return $cart->product->price * $cart->quantity;
            });

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'cartTotal' => $cartTotal,
                'cartCount' => auth()->user()->carts->sum('quantity')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart'
            ], 500);
        }
    }

    public function remove(Cart $cart)
    {
        try {
            $cart->delete();

            // Hitung total cart setelah item dihapus
            $cartTotal = auth()->user()->carts()->with('product')->get()->sum(function($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $cartCount = auth()->user()->carts()->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart',
                'cartTotal' => $cartTotal,
                'cartCount' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove product from cart'
            ], 500);
        }
    }

    public function count()
    {
        $count = auth()->user()->carts()->sum('quantity');
        return response()->json(['count' => $count]);
    }

    public function toggleSelection(Cart $cart)
    {
        try {
            \Log::info('Toggling selection for cart:', [
                'cart_id' => $cart->id,
                'current_selected' => $cart->selected
            ]);
            
            // Toggle status selected
            $cart->selected = !$cart->selected;
            $cart->save();
            
            \Log::info('Cart selected status updated:', [
                'new_selected' => $cart->selected
            ]);
            
            // Hitung total dari item yang dipilih
            $selectedTotal = auth()->user()->carts()
                ->where('selected', true)
                ->with('product')
                ->get()
                ->sum(function($cart) {
                    return $cart->product->price * $cart->quantity;
                });

            $selectedCount = auth()->user()->carts()
                ->where('selected', true)
                ->count();

            \Log::info('Cart calculations:', [
                'selectedTotal' => $selectedTotal,
                'selectedCount' => $selectedCount
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Selection updated',
                'selectedTotal' => $selectedTotal,
                'selectedCount' => $selectedCount,
                'isSelected' => $cart->selected
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart Selection Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update selection: ' . $e->getMessage()
            ], 500);
        }
    }
} 