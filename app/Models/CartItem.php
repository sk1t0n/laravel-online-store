<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class CartItem extends Model
{
    use AsSource;
    use Attachable;
    use Filterable;
    use HasFactory;
    use HasUuids;

    protected $allowedFilters = [
        'id',
    ];

    protected $allowedSorts = [
        'id',
    ];

    protected $fillable = [
        'cart_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function addProduct(string $cartId, string $productId): ?string
    {
        $product = Product::findOrFail($productId);
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)->first();
        $message = __('cart.add_warning');

        if (is_null($cartItem)) {
            $message = null;
            CartItem::create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'price' => $product->price,
                'quantity' => 1,
            ]);
        }

        return $message;
    }

    public function loadProducts(): ?Collection
    {
        $sessionId = session()->getId();
        $cart = Cart::where('session_id', $sessionId)->first();

        if (is_null($cart)) {
            return null;
        }

        return CartItem::where('cart_id', $cart->id)
            ->join('products', 'product_id', '=', 'products.id')
            ->select('products.name', 'products.price')
            ->get()
        ;
    }
}
