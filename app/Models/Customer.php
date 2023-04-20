<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Customer extends Model
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

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
