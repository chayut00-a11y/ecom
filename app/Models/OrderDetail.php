<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    
    public function address_list()
    {
        return $this->belongsTo(Address::class, 'address', 'id');
    }

}
