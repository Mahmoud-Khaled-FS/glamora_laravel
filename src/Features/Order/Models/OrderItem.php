<?php

namespace Src\Features\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Products\Models\Product;

class OrderItem extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
