<?php

namespace App\Services\Recommendation\Contracts;

interface IRecommendationService
{
    public function latestViewRecommend($ip);
}