<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Response\ResponseHandler;
use App\Services\Product\Contracts\IProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function create(Request $request)
    {
        try
        {
            $request->validate(
                [
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]
            );

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
           
            $result = $this->productService->create(
                [
                    'title' => $request->title,
                    'content' => $request->content,
                ],
                $imageName
            );

            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ], $result->getStatusCode()
                );
            }

            return new ProductResource($result);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function list(Request $request)
    {
        try
        {
            $result = $this->productService->list($request->limit);
            
            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ], $result->getStatusCode()
                );
            }

            return new ProductCollection($result);

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function find($id)
    {
        try
        {
            $result = $this->productService->find($id);
                        
            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ], $result->getStatusCode()
                );
            }

            return new ProductResource($result);
        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function update(Request $request)
    {
        try
        {

        }catch(Exception $e)
        {
            return response()->json(
                [
                    'message' => $e->getMessage()
                ] , 500
            );
        }
    }

    public function delete(int $id)
    {
        try
        {

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
