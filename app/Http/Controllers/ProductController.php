<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    public function product_list(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::paginate(5);
        return view('admin.product.product_list',[
            'categories'=>$categories,'subcategories'=>$subcategories,'products'=>$products,
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

        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'brand_id'=>'required',
            'product_name'=>'required',
            'price'=>'required',
            'discount'=>'nullable',
            'short_des'=>'required',
            'tags'=>'required',
            'long_des'=>'required',
            'addi_info'=>'required',
            'preview'=>'required',

        ]);
            $makeSlug = array("@","#","(",")","*","/"," ",'"');
            $slug = Str::lower(str_replace($makeSlug,'-',$request->product_name)).'-'.random_int(6000,7000);
        if ($request->hasFile('preview')) {
            $image = $request->file('preview');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_path = 'uploads/product/preview/' . $image_name;
            $image->move(public_path('uploads/product/preview/'), $image_name);
        }


        $product = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' =>  $request->price -  $request->price*$request->discount/100,
            'tags' => implode(',',$request->tags),
            'short_desc' => $request->short_des,
            'long_desc' => $request->long_des,
            'addi_info' => $request->addi_info,
            'preview' => $image_path,
            'slug' => $slug,
        ]);

        $product_id = $product->id;
        $galleris = $request->gallery;
        foreach($galleris as $gallery){
            $image_name = time() . '.' . $gallery->getClientOriginalExtension();
            $image_path = 'uploads/product/gallery/' . $image_name;
            $gallery->move(public_path('uploads/product/gallery/'), $image_name);

            ProductGallery::insert([
                'product_id'=>$product_id,
                'gallery'=>$image_path,
                'created_at'=>Carbon::now(),
            ]);
        }
        return redirect()->route('product.list');

    }

    public function getsubcategory(Request $request){
        $str = '<option value="">Select Category</option>';
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }

    public function product_edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product_edit',compact('product','subcategories','categories','brands'));
    }

    public function product_update(Request $request,$id){
        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'brand_id'=>'required',
            'product_name'=>'nullable',
            'price'=>'nullable',
            'discount'=>'nullable',
            'short_des'=>'nullable',
            'tags'=>'nullable',
            'long_des'=>'nullable',
            'addi_info'=>'nullable',
            'preview'=>'nullable',

        ]);
    }

    public function getStatus(Request $request){
        Product::find($request->product_id)->update([
            'status'=>$request->status,
        ]);
    }

    public function product_delete($id){
        $products = Product::find($id);
        $products->delete();
        return back();
    }
}
