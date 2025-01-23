<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
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
            'category_name'=>'required|unique:categories',
            'icon'=>'required',
            'icon'=>'image',
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

    public function category_soft_delete($id){
         Category::find($id)->delete();

        return redirect()->route('category.list')->with('soft_delete','Category Move To Trash');
    }

    public function category_trash(){
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.trash',['categories'=>$categories,]);
    }

    public function category_restore($id){
         Category::onlyTrashed()->find($id)->restore();
        return back()->with('restore','Category Restore Successfully');
    }

    public function category_permanent_delete($id){
        $cat = Category::onlyTrashed()->find($id);
        $cat_image = public_path('uploads/category/'.$cat->icon);
        unlink($cat_image);
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        Subcategory::where('category_id',$id)->delete();
        return back()->with('permanentDelete','Category Permanent Deleted Successfully');
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category.update_category',[
            'category'=>$category,
        ]);
    }

    public function category_update(Request $request, $id){

        $request->validate([
            'category_name'=>'required',
        ]);

        if($request->icon == ''){
            Category::find($id)->update([
                'category_name'=>$request->category_name,
            ]);
            return back();
        }
        else{
            $cat = Category::find($id);
            $category_image = public_path('uploads/category/'.$cat->icon);
            unlink($category_image);

            $icon = $request->file('icon');
            $file_name = Str::slug($request->category_name) . '-' . time() . '.webp';
            $upload_path = public_path('uploads/category/');
            $icon->move($upload_path, $file_name);

            Category::find($id)->update([
                'category_name'=>$request->category_name,
                'icon'=>$file_name
            ]);
            return redirect()->route('category.list')->with('update','Category Updated Successfully');
        }
    }

    public function checked_delete(Request $request){
        foreach($request->category_id as $category){
            Category::find($category)->delete();
        }
        return back();
    }

    public function checked_restore(Request $request){
        foreach($request->category_id as $category){
            Category::onlyTrashed($category)->restore();
        }
        return back()->with('restore','Category Restore Successfully');
    }


}
