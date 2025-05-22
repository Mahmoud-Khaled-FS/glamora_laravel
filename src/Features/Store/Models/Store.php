<?php

namespace Src\Features\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Products\Models\Product;

class Store extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $casts = [
        'social_links' => 'array'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];
}
