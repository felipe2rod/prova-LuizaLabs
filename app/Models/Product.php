<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;

   public $timestamps = false;

   protected $fillable = [
        'name',
        'price'
   ];

   public function colors()
   {
      return $this->belongsToMany(Color::class,'product_has_product_colors');
   }

   public function sizes()
   {
      return $this->belongsToMany(Size::class,'product_has_product_sizes');
   }
}
