<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
   public function get_category(){
        $categories = Category::all();
        return response()->json($categories);
   }
}
