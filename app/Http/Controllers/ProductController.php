<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $categoryId = $request->filled('category') ? $request->category : null;

        if ($categoryId) {
            $products = Product::with('category')->where('category_id', $categoryId)->paginate(6);
        } else {
            $products = Product::with('category')->paginate(6);
        }

        return Inertia::render('Index', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @return \Inertia\Response
     */
    public function show(string $productId)
    {
        $product = Product::with('category')->findOrFail($productId);

        return Inertia::render('Product', compact('product'));
    }
}
