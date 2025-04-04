<?php

namespace Src\Features\Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
