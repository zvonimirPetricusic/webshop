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

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function modifiers()
    {
        return $this->hasMany(OrderModifier::class);
    }
}
