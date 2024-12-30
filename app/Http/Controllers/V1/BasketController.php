<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Basket\BasketCollection;
use App\Response\ResponseHandler;
use App\Services\Basket\Contracts\IBasketService;
use Exception;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    protected IBasketService $basketService;

    public function __construct(IBasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'count' => 'required|integer'
        ]);

        try
        {
            $result = $this->basketService->add(
                auth()->user()->id,
                $request->product_id,
                $request->count
            );

            if($result instanceof ResponseHandler)
            {
                return response()->json([
                    'message' => $result->getMessage()
                ], $result->getStatusCode()); 
            }

            return response()->noContent(201);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function delete($product_id)
    {
        try
        {
            $result = $this->basketService->delete(auth()->user()->id, $product_id);


            if($result instanceof ResponseHandler)
            {
                return response()->json([
                    'message' => $result->getMessage()
                ], $result->getStatusCode()); 
            }

            return response()->noContent(200);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function list()
    {
        try
        {
            $result = $this->basketService->list(); 


            if($result instanceof ResponseHandler)
            {
                return response()->json([
                    'message' => $result->getMessage()
                ], $result->getStatusCode()); 
            }

            return new BasketCollection($result);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }
}
