<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    
    protected $guarded = ['id'];

    public function ret_to_product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
