<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'modifier_type', 'value'
    ];
}
