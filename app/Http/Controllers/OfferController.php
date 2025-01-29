<?php

namespace App\Http\Controllers;

use App\Models\Offer1;
use App\Models\Offer2;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offer(){
        $offer = Offer1::all();
        $offer2 = Offer2::all();
        return view('admin.offer.offer',compact('offer','offer2'));
    }

    public function offer1_update(Request $request,$id){

        $offer = Offer1::find($id);

        if($request->image == ''){
           $offer->update([
                'title'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'date'=>$request->date,
            ]);

        }
        else{
          $current_location = public_path('uploads/offer/'.$offer->image);

           if(file_exists($current_location)){
            unlink($current_location);
           }
            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'offer1'.'-'.random_int(100,999).'.'.$extension;
            $image->move(public_path('uploads/offer/'),$file_name);

           Offer1::find($id)->update([
                'titel'=>$request->title,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'image'=>$file_name,
                'date'=>$request->date,
           ]);

        }
    }

    public function offer2_update(Request $request,$id){

        $offer2 = Offer2::find($id);

        if($request->image == ''){
           $offer2->update([
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,

            ]);

        }
        else{
          $current_location = public_path('uploads/offer/'.$offer2->image);

           if(file_exists($current_location)){
            unlink($current_location);
           }
            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'offer2'.'-'.random_int(100,999).'.'.$extension;
            $image->move(public_path('uploads/offer/'),$file_name);

           Offer2::find($id)->update([
                'titel'=>$request->title,
                'subtitle'=>$request->subtitle,
                'image'=>$file_name,
           ]);

        }
    }
}
