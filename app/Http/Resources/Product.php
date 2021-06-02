<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Color as ColorResource;
use App\Http\Resources\Size as SizeResource;

class Product extends JsonResource
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
          'name' => $this->name,
          'price' => 'R$ '.number_format($this->price, 2, ',', '.'),
          'color' => $this->color,
          'size' => $this->size
        ];
    }
}
