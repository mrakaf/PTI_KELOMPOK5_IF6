<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()

    {

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->with('orderItems.product')->latest()->paginate(10);
        return view('customer.orders.index', compact('orders'));

    }

    public function show($order)
    {
        $order = Order::with('orderItems.product')->findOrFail($order);;
        return view('customer.orders.show', compact('order'));
    }
}
