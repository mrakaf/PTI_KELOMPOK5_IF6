<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sementara ambil 8 produk terbaru sebagai featured products
        $featuredProducts = Product::where('is_active', true)
                                 ->where('is_featured', true)
                                 ->latest()
                                 ->take(8)
                                 ->get();
                                 
        $newArrivals = Product::where('is_active', true)
                             ->latest()
                             ->take(8)
                             ->get();
                             
        // Tambahkan products dengan pagination
        $products = Product::where('is_active', true)
                         ->latest()
                         ->paginate(12); // 12 items per halaman
                             
        // Get active categories
        $categories = Category::where('is_active', true)->get();
        
        return view('customer.home', compact('featuredProducts', 'newArrivals', 'categories', 'products'));
    }
} 