<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $productId = $request->input('id');
        $sessionId = session()->getId();

        $cart = (new Cart())->getOrCreateCartBySessionId($sessionId);

        $message = (new CartItem())->addProduct($cart->id, $productId);

        return response()->json([
            'message' => $message ?? __('cart.add'),
        ]);
    }

    public function loadProducts()
    {
        $products = (new CartItem())->loadProducts();

        return response()->json([
            'products' => $products,
            'count' => $products ? count($products) : 0,
        ]);
    }

    public function clear()
    {
        $message = (new Cart())->clear();

        return response()->json([
            'message' => $message,
        ]);
    }
}
