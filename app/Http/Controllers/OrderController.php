<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Order;
use App\Http\Controllers\BaseAPIController as BaseAPIController;
use App\Http\Resources\Order as OrderResource;

class OrderController extends BaseAPIController
{
    public function index()
    {
        $Orders = Order::with(['client','orderItem'])->with('orderItem.product')->get();
        return $this->sendResponse(OrderResource::collection($Orders));
    }

    public function show( $id )
    {
        try{
            $Order = Order::with(['client','orderItem'])->with('orderItem.product')->findOrFail($id);
            return $this->sendResponse(new OrderResource($Order));
        }catch(ModelNotFoundException $e){
            return $this->sendError("get error", ['meta' => $e->getMessage()]);
        }
    }
}
