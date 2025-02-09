<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    public function show($order)
    {
        $order = Order::with('orderItems.product')->findOrFail($order);;
        return view('customer.orders.show', compact('order'));
    }
}
