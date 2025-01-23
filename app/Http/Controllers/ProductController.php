<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_list(){
        return view('admin.product.product_list');
    }

    public function product_create(){
        return view('admin.product.product_create');
    }

    public function product_store(Request $request){

    }
}
