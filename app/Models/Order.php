<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_price', 'first_name', 'last_name', 'email', 'phone', 'address', 'city', 'country'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'sku')->withPivot('price', 'quantity');
    }

    public function modifiers()
    {
        return $this->hasMany(OrderModifier::class, 'order_id');
    }

}
