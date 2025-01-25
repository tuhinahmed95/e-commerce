<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function variation(){
        $colors = Color::all();
        $categories = Category::all();
        return view('admin.variation.variation',compact('colors','categories'));
    }

    public function variation_store(Request $request){
        $request->validate([
            'color_name'=>'required',
            'color_code'=>'nullable'
        ]);
        Color::create([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    public function size_store(Request $request){
        $request->validate([
            'category_id'=>'nullable',
            'size_name'=>'required',
        ]);
        Size::create([
            'category_id'=>$request->category_id,
            'size_name'=>$request->size_name,
        ]);
        return back();
    }

    public function variation_delete($id){
        Color::find($id)->delete();
        return back();
    }

    public function size_delete($id){
        $size = Size::find($id);
        $size->delete();
        return back();
    }
}
