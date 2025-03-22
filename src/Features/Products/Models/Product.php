<?php

namespace Src\Features\Products\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Src\Shared\Utils\ModelHelper;

class Product extends Model
{
    protected $guarded;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function image(): Attribute
    {
        return ModelHelper::fileAccessor();
    }

    public function description(): Attribute
    {
        return ModelHelper::defineLocaleAttribute('description');
    }

    public function summary(): Attribute
    {
        return ModelHelper::defineLocaleAttribute('description');
    }

    public function name(): Attribute
    {
        return ModelHelper::defineLocaleAttribute('name');
    }
}
