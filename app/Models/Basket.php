<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public function items()
    {
        return $this->hasMany(BasketItem::class);
    }
}
