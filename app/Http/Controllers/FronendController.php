<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class FronendController extends Controller
{
     function welcome(){
        $banners = Banner::all();
        $categories = Category::all();
        return view('frontend.index',compact('banners','categories'));
    }
}
