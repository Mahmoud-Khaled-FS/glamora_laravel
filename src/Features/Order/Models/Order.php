<?php

namespace Src\Features\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Order\Enum\OrderStatus;
use Src\Features\User\Models\Address;
use Src\Features\User\Models\User;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
