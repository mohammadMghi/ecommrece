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

    public function create($product_array , $image)
    {
        $product = new Product();
 
        $product->title = $product_array['title'];

        $product->content = $product_array['content'];

        $product->price = $product_array['price'];

        $product->image = $image;

        $product->category_id = $product_array['category_id'];

        $product->save();

        return $product;
    }

    public function list($limit)
    {
        return Product::paginate($limit);
    }

    public function update($id , $product_array)
    {
        $product = Product::find($id);
 
        $product->title = $product_array['title'];

        $product->content = $product_array['content'];

        $product->price = $product_array['price'];

        $product->category_id = $product_array['category_id'];

        $product->save();

        return $product;
    }
}