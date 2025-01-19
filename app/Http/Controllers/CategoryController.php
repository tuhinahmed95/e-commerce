<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_list(){
        $categories = Category::all();
        return view('admin.category.category_list',compact('categories'));
    }

    public function category_create(){
        return view('admin.category.create_category');
    }

    public function category_store(Request $request){
        $request->validate([
            'category_name'=>'required',
            'icon'=>'required'
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $file_name = Str::slug($request->category_name) . '-' . time() . '.webp';
            $upload_path = public_path('uploads/category/');
            $icon->move($upload_path, $file_name);
        } else {
            $file_name = 'default.webp';
        }

        Category::create([
            'category_name'=>$request->category_name,
            'icon'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->route('category.list')->with('status','Category Created Successfully');

    }

    public function category_update(){
        return view('admin.category.update_category');
    }
}
