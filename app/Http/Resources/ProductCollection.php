<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    private $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'page' => $resource->currentPage(),
            'size' => $resource->perPage(),
            'max' => $resource->lastPage(),
            'count' => $resource->total(),
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'data' => parent::toArray($request) ,
            'meta' => ["pagination" => $this->pagination]
        ];
    }
}
