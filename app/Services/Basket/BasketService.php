<?php

namespace App\Services\Basket;

use App\Models\Basket;
use App\Response\ResponseHandler;
use App\Services\Basket\Contracts\IBasketService;

class BasketService implements IBasketService
{
    public function add($user_id , $product_id , $count)
    {
        //checks if user has not a basket we should create a new
        $basket = Basket::where('user_id' , $user_id)->where('is_paid' , false)->first();

        if($basket)
        {
            if($product = $basket->items()->where('product_id' , $product_id)->first())
            {
                $product->increase('count' , 1);
            }

            //user has a basket has not paid and we can add our product to the basket
            $basket->items()->create([
                'product_id' => $product_id,
                'count' => $count 
            ]); 
        }

        $basket = new Basket();

        $basket->user_id = $user_id;

        $basket->save();

        $basket->items()->create([
            'product' => $product_id,
            'count' => $count
        ]);

    }

    public function delete($user_id ,$product_id)
    {
        $product = Basket::where('user_id' , $user_id)->where('product_id', $product_id)->first();

        if($product)
        {
            $product->delete();
        }

        return new ResponseHandler('not found', 404);
    }
}