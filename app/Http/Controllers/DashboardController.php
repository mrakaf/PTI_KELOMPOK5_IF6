<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'totalRevenue' => Order::where('status', 'completed')->sum('total_amount'),
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
        ];

        return view('dashboard', $data);
    }
} 