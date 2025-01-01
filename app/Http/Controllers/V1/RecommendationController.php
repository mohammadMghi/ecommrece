<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Recommendation\RecommendationCollection;
use App\Response\ResponseHandler;
use App\Services\Recommendation\Contracts\IRecommendationService;
use Exception;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected IRecommendationService $recommendationService;

    public function __construct(IRecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function latestViewRecommendation(Request $request)
    {
        try
        {
            $result = $this->recommendationService->latestViewRecommend($request->ip());

            if($result instanceof ResponseHandler)
            {
                return response()->json([
                    'message' => $result->getMessage()
                ], $result->getStatusCode());
            }

            return new RecommendationCollection($result);
        }catch(Exception $exception)
        {
            return response()->json([
                'message' => $exception->getMessage()
            ],500);
        }
    }
}
