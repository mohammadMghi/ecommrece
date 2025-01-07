<?php

namespace App\Services\Category\Contracts;

interface ICategoryService
{
    public function add($title);

    public function list($per_page);

    public function delete(int $id);
}