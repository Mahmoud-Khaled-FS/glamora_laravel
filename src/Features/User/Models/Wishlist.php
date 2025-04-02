<?php

namespace Src\Features\User\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Products\Models\Product;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
