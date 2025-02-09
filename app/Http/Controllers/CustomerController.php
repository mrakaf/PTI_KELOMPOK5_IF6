<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('customer.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('customer.show', compact('product'));
    }
}
