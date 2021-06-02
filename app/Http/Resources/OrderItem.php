<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'quantity' =>  $this->quantity,
          'product_name' => $this->product->name,
          'product_size' => $this->product->size,
          'product_color' => $this->product->color,
          'product_price' => 'R$ '.number_format($this->product->price, 2, ',', '.'),
          'product_total_price' => 'R$ '.number_format(($this->product->price * $this->quantity), 2, ',', '.'),
          'decimal_total_price' => ($this->product->price * $this->quantity)
        ];
    }
}
