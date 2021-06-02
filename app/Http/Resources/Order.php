<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\OrderItem as OrderItemResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pay_methods = ['check' => 'cheque', 'credit_card' => 'Cartão de Crédito', 'money' => 'Dinheiro'];
        return [
          'id' => $this->id,
          'order_date' => strftime('%A, %d de %B de %Y', strtotime($this->order_date)),
          'observation' => $this->observation,
          'pay_method' => $pay_methods[ $this->pay_method ],
          'client' => new ClientResource($this->client),
          'items' => OrderItemResource::collection($this->orderItem)
        ];
    }
}
