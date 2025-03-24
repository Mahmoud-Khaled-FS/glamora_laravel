<?php

namespace Src\Features\Products\Models;

use Database\Factories\ProductCategoryFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Shared\Utils\ModelHelper;

class ProductCategory extends Model
{
    use HasFactory;
    static $factory = ProductCategoryFactory::class;

    protected $guarded;

    public function subCategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
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
