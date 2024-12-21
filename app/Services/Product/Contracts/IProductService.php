<?php

namespace App\Services\Product\Contracts;

interface IProductService
{
    public function find($id);

    public function delete($id);

    public function create($product , $image);

    public function list($limit);

    public function update($id , $product);
}