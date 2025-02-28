<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{ 
    protected $fillable = [
        'product_id',
        'count'
    ];

    public function product()
    {
        return $this->hasOne(Product::class ,'id' ,'product_id');
    }
}
