<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\Category\Contracts\ICategoryService;

class CategoryService implements ICategoryService
{
    public function add($title)
    {
        $category = new Category;

        $category->title = $title;

        $category->save();
    }
}