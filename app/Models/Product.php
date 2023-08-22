<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $appends = array('product_category');
    protected $fillable = [
        'name', 
        'description',
        'product_category_id',
        'featured_image',
        'gallery',
        'regular_price',
        'sale_price',
        'weight',
        'show',
    ];


    public function getProductCategoryAttribute()
    {
        return ProductCategory::whereId( $this->product_category_id )->firstOrFail()->name ?: '';  
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';
}
