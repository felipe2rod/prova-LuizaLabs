<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseAPIController as BaseAPIController;
use App\Http\Resources\Product as ProductResource;


class ProductController extends BaseAPIController
{
    public function index()
    {
        $Products = Product::with(['colors','sizes'])->get();
        return $this->sendResponse(ProductResource::collection($Products));
    }
}
