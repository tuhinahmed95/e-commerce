<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_list(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.product.product_list',[
            'categories'=>$categories,'subcategories'=>$subcategories,
        ]);
    }

    public function product_create(){
        $categories = Category::all();
        $brands = Brand::all();
        $subcategories = Subcategory::all();
        return view('admin.product.product_create',[
            'categories'=>$categories,'subcategories'=>$subcategories,'brands'=>$brands,
        ]);
    }

    public function product_store(Request $request){

    }

    public function getsubcategory(Request $request){
        $str = '<option value="">Select Category</option>';
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }
}
