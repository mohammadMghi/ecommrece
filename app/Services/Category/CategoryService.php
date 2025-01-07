<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Response\ResponseHandler;
use App\Services\Category\Contracts\ICategoryService;
use Monolog\ErrorHandler;

class CategoryService implements ICategoryService
{
    public function add($title)
    {
        $category = new Category;

        $category->title = $title;

        $category->save();
    }

    public function list($per_page)
    {
        return Category::paginate($per_page);
    }

    public function delete(int $id)
    {
        $category = Category::find($id);

        if(!$category)
        {
            return new ResponseHandler('not found' , 404);
        }

        return $category->delete();
    }
}