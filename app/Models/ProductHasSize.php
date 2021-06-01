<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHasSize extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'product_has_product_sizes';

    protected $fillable = [
        'product_size_id',
        'product_id'
    ];

}
