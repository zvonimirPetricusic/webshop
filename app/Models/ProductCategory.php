<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'category_id',
    ];

    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
