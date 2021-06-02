<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\BaseAPIController as BaseAPIController;
use App\Http\Resources\Order as OrderResource;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use Mail;

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


    public function update(OrderRequest $request)
    {
        try{
            $id = $request->route('id');
            Order::find($id)->update($request->validated());
            return $this->sendResponse("Successfully updated");
        }catch(Exception $e){
            return $this->sendError("update error", ['meta' => $e->getMessage()], Response::HTTP_ERROR);
        }
    }

    public function delete( $id )
    {
        try{
            $Order = Order::findOrFail($id);
            $Order->delete();
            return $this->sendResponse('Successfully deleted');
        }catch(ModelNotFoundException $e){
            return $this->sendError("delete error", ['meta' => $e->getMessage()]);

        }
    }

    public function mail( $id )
    {
        try{
            $Order = Order::with(['client','orderItem'])->with('orderItem.product')->findOrFail($id);
            //$resource = new OrderResource($Order);
            $data = $Order->toArray();
            /*
            $total_values = array_sum(array_map(function($item) { 
                    return $item['quantity']*$item['decimal_total_price']; 
            }, $data->items));
            */

            Mail::to('felipe2rod@gmail.com')->send(new OrderMail($data));
            return $this->sendResponse($data);
        }catch(ModelNotFoundException $e){
            return $this->sendError("mail error", ['meta' => $e->getMessage()]);
        }
        
    }
}
