<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Offer1;
use App\Models\Offer2;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FronendController extends Controller
{
    public function welcome(){
        $banners = Banner::all();
        $categories = Category::all();
        $offer = Offer1::all();
        $offer2 = Offer2::all();
        $products = Product::latest()->take(8)->get();
        return view('frontend.index',compact('banners','categories','offer','offer2','products'));
    }

   public function subscribe_store(Request $request){
        $request->validate([
            'customer_id'=>'nullable',
            'email'=>'required'
        ]);
        Subscribe::insert([
            'customer_id'=>1,
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
        return back();
   }

   public function subscribe(){

    $subscribers = Subscribe::all();
    return view('admin.subscribe.subscribe',compact('subscribers'));

   }

   public function product_details($slug){

    $product_id = Product::where('slug',$slug)->first()->id;
    $product_info = Product::find($product_id);
    $product_gallery = ProductGallery::where('product_id',$product_id)->get();
    $varient_color = Inventory::where('product_id',$product_id)
    ->groupBy('color_id')
    ->selectRaw('sum(color_id) as sum ,color_id')
    ->get();
    $varient_sizes = Inventory::where('product_id',$product_id)
    ->groupBy('size_id')
    ->selectRaw('sum(size_id) as sum , size_id')
    ->get();

    return view('frontend.product_details',compact('product_info','product_gallery','varient_color','varient_sizes'));
   }

   public function getSize(Request $request){
       $str = '';
       $sizes = Inventory::where('color_id', $request->color_id)->where('product_id',$request->product_id)->get();
      foreach($sizes as $size){
        if($size->relt_size->size_name == 'NA'){
            $str = '<li class="color"><input checked class="size_id" type="radio" id="size'.$size->size_id.'" name="size_id" value="size'.$size->size_id.'">
            <label for="size'.$size->size_id.'">'.$size->relt_size->size_name.'</label>
            </li>';
        }else{
            $str .= '<li class="color"><input class="size_id" type="radio" id="size'.$size->size_id.'" name="size_id" value="size'.$size->size_id.'">
            <label for="size'.$size->size_id.'">'.$size->relt_size->size_name.'</label>
            </li>';
        }
        echo $str;
      }
   }

//    public function getQuantity(Request $request){
//     echo $request->color_id.$request->product_id.$request->size_id;
//    }
}
