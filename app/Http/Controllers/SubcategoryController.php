<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function subcategory_list(){
        $subcategories = Subcategory::all();
        return view('admin.subcategory.subcategory_list',[
            'subcategories'=>$subcategories,
        ]);
    }

    public function sub_create(){
        $categories = Category::all();
        return view('admin.subcategory.create_sub_cat',[
            'categories'=>$categories,
        ]);
    }

    public function subcategory_store(Request $request){
        $request->validate([
            'category'=>'required',
            'sub_category'=>'required',
            'sub_image'=>'required'
        ]);

        if ($request->hasFile('sub_image')) {
            $image = $request->file('sub_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = 'uploads/subcategoy/' . $image_name;
            $image->move(public_path('uploads/subcategoy'), $image_name);
        }


        SubCategory::create([
            'category_id' => $request->category,
            'subcategory_name' => $request->sub_category,
            'sub_image' => $image_path,
        ]);
        return redirect()->route('sub.category.list');

    }

    public function subcategory_edit($id){
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.subcategory_edit',compact('subcategory','categories'));
    }

    public function subcategory_update(Request $request,$id){
            $request->validate([
                'category'=>'required',
                'sub_category'=>'required',
                'sub_image'=>'nullable'
            ]);
            $subcategorie = Subcategory::find($id);

            if ($request->hasFile('sub_image')) {
                $oldImagePath = str_replace('uploads/category', '', $subcategorie->sub_image);

                if (file_exists(public_path($oldImagePath)) && $subcategorie->sub_image) {
                    unlink(public_path($oldImagePath));
                }

                $image = $request->file('sub_image');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $imageName);

                $subcategorie->sub_image = 'uploads/category/' . $imageName;
            }
            $subcategorie->update([
                'category_id' => $request->category,
                'sub_category' => $request->sub_category,
                'sub_image' => $subcategorie,  
            ]);
            return redirect()->route('sub.category.list');

    }
}
