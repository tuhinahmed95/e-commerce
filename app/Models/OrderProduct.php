<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function rel_to_product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
