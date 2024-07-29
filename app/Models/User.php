<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'address', 'city', 'country', 'contract_list_id',
    ];

    public function contractList()
    {
        return $this->belongsTo(ContractList::class, 'contract_list_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}
