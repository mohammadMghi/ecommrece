<?php

namespace App\Services\Basket\Contracts;

interface IBasketService
{
    public function add($user_id , $product_id, $count);

    public function delete($user_id ,$product_id);

    public function list();
}