<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
  public function index()
  {
    $totalCustomers = User::where('role', 'customer')->count();
    $totalRevenue = Order::where('status', 'completed')->sum('total_amount') ?? 0;
    $totalOrders = Order::count();
    $totalProducts = Product::count();
    $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
    $topProducts = Product::withCount('orders')->orderByDesc('orders_count')->take(5)->get();
    $recentOrders = Order::with('user')->withCount('products')->orderBy('created_at', 'desc')->take(5)->get();

    return view('analytics.index', compact(
      'totalCustomers',
      'totalRevenue',
      'totalOrders',
      'totalProducts',
      'averageOrderValue',
      'topProducts',
      'recentOrders'
    ));
  }
}
