<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Response\ResponseHandler;
use App\Services\Category\Contracts\ICategoryService;
use Exception;
use Illuminate\Http\Request;
use Phpml\Recommender\CollaborativeFiltering;
class CategoriesController extends Controller
{
    protected ICategoryService $categoryService;
    
    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function add(Request $request)
    {
        $request->validate([
            'title' => 'string|unique:categories,title'    
        ]);

        try
        {    
            $result = $this->categoryService->add($request->title);

            if($result instanceof ResponseHandler)
            {
                return response()->json(
                    [
                        'message' => $result->getMessage()
                    ], $result->getStatusCode()
                );
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

    public function list(Request $request)
    {
        $result = $this->categoryService->list($request->per_page);

        return response()->json([
            'data' => $result
        ]);
    }

    public function delete(int $id)
    { 
        $result = $this->categoryService->delete($id);

        if($result instanceof ResponseHandler)
        {   
            return response()->json([
                'message' => $result->getMessage()
            ] , $result->getStatusCode());
        }

        return response()->noContent(200);
    }
}
