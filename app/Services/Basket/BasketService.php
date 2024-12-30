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
        $basket = Basket::where('user_id' , $user_id)
        ->where('is_paid' , false)->first();
     
        if($basket)
        {    
            if($product = $basket->items()->where('product_id' , $product_id)->first())
            {  
                $product->count += $count;

                $product->save();

                return;
            }
       
            //user has a basket has not paid and we can add our product to the basket
            $basket->items()->create([
                'product_id' => $product_id,
                'count' => $count 
            ]);

            return;
        }

        $basket = new Basket();

        $basket->user_id = $user_id;

        $basket->save();

        $basket->items()->create([
            'product_id' => $product_id,
            'count' => $count
        ]);

    }

    public function delete($user_id ,$product_id)
    {    
        $items = Basket::where('user_id' , $user_id)
        ->where('is_paid' , false)->first()->items();

        $product = $items->get()->where('product_id' , $product_id)->first();
 

        if($product)
        {
            return $product->delete();
        }

        return new ResponseHandler('not found', 404);
    }

    public function list()
    {
        return Basket::with('items.product')->paginate();
    }
}