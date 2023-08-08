<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'featured_image',
        'gallery',
        'regular_price',
        'sale_price',
        'weight',
        'show',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';
}
