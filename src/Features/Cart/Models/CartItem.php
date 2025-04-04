<?php

namespace Src\Features\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Products\Models\Product;

class CartItem extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
