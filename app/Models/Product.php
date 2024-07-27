<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'sku';
    public $incrementing = false;

    protected $fillable = [
        'sku', 'title', 'description', 'price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'sku', 'category_id');
    }

    public function priceListProducts()
    {
        return $this->hasMany(PriceListProduct::class, 'sku', 'sku');
    }

    public function contractListProducts()
    {
        return $this->hasMany(ContractListProduct::class, 'sku', 'sku');
    }
    
}
