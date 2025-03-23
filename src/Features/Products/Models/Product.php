<?php

namespace Src\Features\Products\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Features\Rating\Models\Rating;
use Src\Shared\Utils\ModelHelper;

class Product extends Model
{
    use HasFactory;
    static $factory = ProductFactory::class;

    protected $guarded;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
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
