<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('product')->get();
        return view('customer.wishlist.index', compact('wishlists'));
    }

    public function toggle($productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $userId = auth()->id();

            $wishlist = Wishlist::where('user_id', $userId)
                               ->where('product_id', $productId)
                               ->first();

            if ($wishlist) {
                $wishlist->delete();
                return response()->json([
                    'added' => false,
                    'message' => 'Product removed from wishlist'
                ]);
            }

            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);

            return response()->json([
                'added' => true,
                'message' => 'Product added to wishlist'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update wishlist'
            ], 500);
        }
    }
} 