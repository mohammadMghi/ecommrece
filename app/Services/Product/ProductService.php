<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\Contracts\IProductService;

class ProductService implements IProductService
{  
    public function find($id)
    {
        return Product::find($id);
    }

    public function delete($id)
    {
        $result = Product::where('id',$id)->delete();

        if($result) return true;

        return false;
    }

    public function create($product , $image)
    {
        $product = new Product();

        $product->title = $product['title'];

        $product->content = $product['content'];

        $product->image = $image;

        $product->save();
    }

    public function list($limit)
    {

    }

    public function update($id , $product)
    {

    }
}