<?php

namespace Src\Features\Rating\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\User\Models\User;

class Rating extends Model
{
    protected $guarded;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rateable()
    {
        return $this->morphTo();
    }
}
