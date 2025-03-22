<?php

namespace Src\Features\Products\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Src\Shared\Utils\ModelHelper;
use Storage;

class ProductCategory extends Model
{
    protected $guarded;

    public function subCategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function image(): Attribute
    {
        return ModelHelper::fileAccessor();
    }

    public function name(): Attribute
    {
        return ModelHelper::defineLocaleAttribute('name');
    }

    public function description(): Attribute
    {
        return ModelHelper::defineLocaleAttribute('description');
    }
}
