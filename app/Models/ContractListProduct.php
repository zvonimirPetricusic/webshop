<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractListProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'sku', 'contract_list_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }

    public function contractList()
    {
        return $this->belongsTo(ContractList::class, 'contract_list_id');
    }
}
