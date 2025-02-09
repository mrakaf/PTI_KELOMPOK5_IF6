<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('product')->get();
        return view('customer.wishlist.index', compact('wishlists'));
    }

    public function add(Product $product)
    {
        try {
            $user = auth()->user();
            
            // Check if product already in wishlist
            $exists = $user->wishlists()->where('product_id', $product->id)->exists();
            
            if (!$exists) {
                $user->wishlists()->create([
                    'product_id' => $product->id
                ]);
                $message = 'Product added to wishlist';
            } else {
                $user->wishlists()->where('product_id', $product->id)->delete();
                $message = 'Product removed from wishlist';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'wishlistCount' => $user->wishlists()->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update wishlist'
            ], 500);
        }
    }

    public function count()
    {
        $count = auth()->user()->wishlists()->count();
        return response()->json(['count' => $count]);
    }

    public function remove(Wishlist $wishlist)
    {
        // Implementation for removing from wishlist
    }

    public function toggle(Product $product)
    {
        try {
            $user = auth()->user();
            
            // Check if product already in wishlist
            $exists = $user->wishlists()->where('product_id', $product->id)->exists();
            
            if (!$exists) {
                $user->wishlists()->create([
                    'product_id' => $product->id
                ]);
                $message = 'Product added to wishlist';
            } else {
                $user->wishlists()->where('product_id', $product->id)->delete();
                $message = 'Product removed from wishlist';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'wishlistCount' => $user->wishlists()->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update wishlist'
            ], 500);
        }
    }
} 