<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
