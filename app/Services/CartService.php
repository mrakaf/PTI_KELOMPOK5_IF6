<?php

namespace App\Services;

use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartService
{
    public static function getCount()
    {
        return Cart::session(auth()->id())->getTotalQuantity();
    }

    public static function getContent()
    {
        return Cart::session(auth()->id())->getContent();
    }

    public static function getTotal()
    {
        return Cart::session(auth()->id())->getTotal();
    }
} 