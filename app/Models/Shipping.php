<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public function rel_to_city(){
        return $this->belongsTo(City::class, 'shif_city_id');
    }

    public function rel_to_country(){
        return $this->belongsTo(Country::class, 'shif_country_id');
    }
}
