<?php

namespace App\Services\Basket\Contracts;

interface IBasketService
{
    public function add($user_id , $product_id, $count);
}