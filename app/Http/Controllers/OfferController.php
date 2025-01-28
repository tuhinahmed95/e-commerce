<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offer(){
        return view('admin.offer.offer');
    }
}
