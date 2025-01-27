<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'quantity',
    ];

    public function rel_color(){
        return $this->belongsTo(Color::class,'color_id');
    }

    public function relt_size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
