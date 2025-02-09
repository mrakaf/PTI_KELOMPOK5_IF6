<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['category'])->get();
            return view('customer.index', compact('products'));
        } catch (\Exception $e) {
            \Log::error('Error in CustomerController@index: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
} 