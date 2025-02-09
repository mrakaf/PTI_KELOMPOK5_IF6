<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'Completed')->count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $cancelledOrders = Order::where('status', 'Cancelled')->count();

        // Debugging untuk memastikan data ada

        return view('orders.index', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'cancelledOrders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        Order::create($request->all());

        return view('orders.index', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'cancelledOrders'))->with('success', 'Order created successfully.');
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return view('orders.index', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'cancelledOrders'))->with('success', 'Order updated successfully.');
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return view('orders.index', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'cancelledOrders'))->with('success', 'Order deleted successfully.');
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    /**
     * Approve the specified order.
     */
    public function approve(string $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Completed']);

        return view('orders.index', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'cancelledOrders'))->with('success', 'Order approved successfully.');
        return redirect()->route('orders.index')->with('success', 'Order approved successfully.');
    }

    /**
     * Reject the specified order.
     */
    public function reject(string $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'Cancelled']);

        return view('orders.index', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'cancelledOrders'))->with('success', 'Order rejected successfully.');
        return redirect()->route('orders.index')->with('success', 'Order rejected successfully.');
    }
}
