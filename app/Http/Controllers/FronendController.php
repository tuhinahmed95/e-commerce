<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Offer1;
use App\Models\Offer2;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Faq;
use App\Models\Inventory;
use App\Models\Subscribe;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
    $reviews = OrderProduct::where('product_id',$product_id)->whereNotNull('review')->get();
    $total_review = OrderProduct::where('product_id',$product_id)->whereNotNull('review')->count();
    $total_star = OrderProduct::where('product_id',$product_id)->whereNotNull('review')->sum('star');
    $varient_color = Inventory::where('product_id',$product_id)
    ->groupBy('color_id')
    ->selectRaw('sum(color_id) as sum ,color_id')
    ->get();
    $varient_sizes = Inventory::where('product_id',$product_id)
    ->groupBy('size_id')
    ->selectRaw('sum(size_id) as sum , size_id')
    ->get();

    // cookies set for recent view page
    $all = Cookie::get('recent-view');
    if(!$all){
        $all = "[]";
    }
    $all_info = json_decode($all,true);
    $all_info = Arr::prepend($all_info, $product_id);
    $recent_product_id = json_encode($all_info);
    Cookie::queue('recent-view',$recent_product_id,1000);

    return view('frontend.product_details',compact('product_info','product_gallery','varient_color','varient_sizes','reviews','total_review','total_star',));
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

   public function review_store(Request $request, $id){
        $request->validate([
            'review'=>'required',
            'stars'=>'required',
        ]);
        OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id',$id)->first()->update([
            'review'=> $request->review,
            'star'=> $request->stars,
            'updated_at'=> Carbon::now(),
        ]);
        return back()->with('review','Your Review Has Been Submited');
    }

//    public function getQuantity(Request $request){
//     echo $request->color_id.$request->product_id.$request->size_id;
//    }

    public function shop(Request $request){

        $data =  $request->all();

        $base = "created_at";
        $type = 'DESC';
        if(!empty($data['sort']) && $data['sort'] != '' && $data['sort'] != 'undefined'){
           if($data['sort'] == 1){
                $base = "created_at";
                $type = 'ASC';
           }
           else if($data['sort'] == 2){
            $base = 'price';
            $type = 'DESC';
           }
           else if($data['sort'] == 3){
            $base = 'product_name';
            $type = 'ASC';
           }
           else if($data['sort'] == 4){
            $base = 'product_name';
            $type = 'DESC';
           }
        }

        $products = Product::where(function ($q) use ($data){
            $min = 0;
            $max = 0;
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined'){
                $min = $data['min'];
            }
            else{
                $min = 1;
            }

            if(!empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                $max = $data['max'];
            }
            else{
                $max = Product::max('price');
            }


            if(!empty($data['search_input']) && $data['search_input'] != '' && $data['search_input'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('product_name', 'like', '%'.$data['search_input'].'%');
                    $q->orwhere('long_desc', 'like', '%'.$data['search_input'].'%');
                    $q->orwhere('addi_info', 'like', '%'.$data['search_input'].'%');
                });
            }
            if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('category_id',$data['category_id']);

                });
            }
            if(!empty($data['tag']) && $data['tag'] != '' && $data['tag'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $all = '';
                    foreach(Product::all() as $product){
                        $explode = explode(',', $product->tags);
                        if(in_array($data['tag'], $explode)){
                            $all .= $product->id.',';
                        }
                    }
                    $explode2 = explode(',',$all);
                    $q->find($explode2);
                });
            }
            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                $q->whereHas('rel_to_inventory',function($q) use ($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                        $q->whereHas('rel_color',function($q) use ($data){
                            $q->where('colors.id',$data['color_id']);

                        });
                    }

                });
            }
            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                $q->whereHas('rel_to_inventory',function($q) use ($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                        $q->whereHas('rel_color',function($q) use ($data){
                            $q->where('colors.id',$data['color_id']);

                        });
                    }
                    if(!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                        $q->whereHas('relt_size',function($q) use ($data){
                            $q->where('sizes.id',$data['size_id']);

                        });
                    }

                });
            }
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['min'] != 'undefined'){
                    $q->whereBetween('price',[$min , $max]);

            }
        })->orderBy($base , $type)->get();


        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tag::all();
        return view('frontend.shop', compact('products','categories','colors','sizes','tags'));
    }

    public function recent_view(){
        $recent_info =  json_decode(Cookie::get('recent-view'), true);
        if($recent_info == null){
            $recent_view_product = [];
            $recent_view = array_unique($recent_info);
        }
        else{
            $recent_view = array_unique($recent_info);
        }
        $recents = Product::find($recent_view);
        return view('frontend.recent_view',compact('recents'));
    }

    public function faqs(){
        $faqs = Faq::all();
        return view('frontend.faq',compact('faqs'));
    }


}
