<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Cart $cart, CartItem $cartItem, Request $request)
    {
        $productId = $request->input('id');
        $sessionId = session()->getId();

        $cart = $cart->getOrCreateCartBySessionId($sessionId);
        $message = $cartItem->addProduct($cart->id, $productId);

        return response()->json([
            'message' => $message ?? __('cart.add'),
        ]);
    }

    public function loadProducts(CartItem $cartItem)
    {
        $products = $cartItem->loadProducts();

        return response()->json([
            'products' => $products,
            'count' => $products ? count($products) : 0,
        ]);
    }

    public function clear(Cart $cart)
    {
        $message = $cart->clear();

        return response()->json([
            'message' => $message,
        ]);
    }
}
