<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\BaseAPIController as BaseAPIController;
use App\Http\Resources\Product as ProductResource;


class ProductController extends BaseAPIController
{
    public function index()
    {
        $Products = Product::all();
        return $this->sendResponse(ProductResource::collection($Products));
    }

    public function create(ProductRequest $request)
    {
        try{
            Product::create($request->all());
            return $this->sendResponse("Successfully created");
        }catch(Exception $e){
            return $this->sendError("create error", ['meta' => $e->getMessage()], Response::HTTP_ERROR);
        }
        
    }

    public function show( $id )
    {
        try{
            $Product = Product::findOrFail($id);
            return $this->sendResponse(new ProductResource($Product));
        }catch(ModelNotFoundException $e){
            return $this->sendError("get error", ['meta' => $e->getMessage()]);

        }
    }

    public function update(ProductRequest $request)
    {
        try{
            $id = $request->route('id');
            Product::find($id)->update($request->validated());
            return $this->sendResponse("Successfully updated");
        }catch(Exception $e){
            return $this->sendError("update error", ['meta' => $e->getMessage()], Response::HTTP_ERROR);
        }
    }

    public function delete( $id )
    {
        try{
            $Product = Product::findOrFail($id);
            $Product->delete();
            return $this->sendResponse('Successfully deleted');
        }catch(ModelNotFoundException $e){
            return $this->sendError("delete error", ['meta' => $e->getMessage()]);

        }
    }
}
