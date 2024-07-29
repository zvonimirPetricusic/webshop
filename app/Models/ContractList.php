<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'contract_list_products', 'contract_list_id', 'sku')->withPivot('price');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'contract_list_id');
    }
}
