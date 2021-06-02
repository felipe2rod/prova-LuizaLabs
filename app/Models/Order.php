<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   use HasFactory;

   public $timestamps = false;

   protected $fillable = [
        'order_date',
        'observation',
        'pay_method',
        'client_id'
   ];

   public function client()
   {
      return $this->belongsTo(Client::class, 'client_id');
   }

   public function orderItem()
   {
      return $this->hasMany(OrderItem::class, 'order_id');
   }

}
