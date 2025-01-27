<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;

use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner(){
        $categories = Category::all();
        $banners = Banner::all();
        return view('admin.banner.banner',compact('categories','banners'));
    }

    public function banner_store(Request $request){
        $request->validate([
            'title'=>'nullable',
            'image'=>'required'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/banner/'),$image_name);
        }
        Banner::insert([
            'title'=>$request->title,
            'image'=>$image_name,
            'category_id'=>$request->id,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
