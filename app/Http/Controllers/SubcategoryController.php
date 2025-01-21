<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function subcategory_list(){
        $categories = Category::all();
        return $categories;
        return view('admin.subcategory.subcategory_list',compact('categories'));
    }

    public function sub_create(){
        return view('admin.subcategory.create_sub_cat');
    }

    public function subcategory_store(Request $request){

    }
}
