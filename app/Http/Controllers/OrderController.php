<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\BaseAPIController as BaseAPIController;
use App\Http\Resources\Order as OrderResource;
use App\Http\Requests\OrderRequest;

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

    public function create(OrderRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->all();
            $Order = new Order();
            $Order->order_date = $data['order_date'];
            $Order->observation = $data['observation'];
            $Order->pay_method = $data['pay_method'];
            $Order->client_id = $data['client_id'];
            $Order->save();

            foreach($data['items'] as $item){
                $OrderItem = new OrderItem();
                $OrderItem->order_id = $Order->id;
                $OrderItem->quantity = $item['quantity'];
                $OrderItem->product_id = $item['product_id'];
                $OrderItem->save();
            }

            DB::commit();
            return $this->sendResponse('Successfully created');
        }catch(Exception $e){
            DB::rollBack();
            return $this->sendError("create error", ['meta' => $e->getMessage()], Response::HTTP_ERROR);
        }
    }
}
