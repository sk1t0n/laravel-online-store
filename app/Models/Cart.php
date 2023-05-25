<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Cart extends Model
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
        'session_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getOrCreateCartBySessionId(string $sessionId): self
    {
        $cart = Cart::where('session_id', $sessionId)->first();

        if (is_null($cart)) {
            $cart = Cart::create([
                'session_id' => $sessionId,
            ]);
        }

        return $cart;
    }

    public function clear(): ?string
    {
        $sessionId = session()->getId();
        $deleted = Cart::where('session_id', $sessionId)->delete();

        return $deleted ? __('cart.clear') : null;
    }
}
