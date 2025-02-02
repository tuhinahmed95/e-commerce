<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function cupon_list(){
        $cupons = Cupon::all();
        return view('admin.coupon.coupon_list',compact('cupons'));
    }

    public function cupon_create(){
        return view('admin.coupon.coupon_create');
    }

    public function cupon_store(Request $request){
        $request->validate([
            'cupon'=>'required',
            'type'=>'required',
            'amount'=>'required',
            'validity'=>'required',
            'limit'=>'nullable',
            'created_at'=>Carbon::now(),
        ]);
        Cupon::create([
            'coupon'=>$request->cupon,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'validity'=>$request->validity,
            'limit'=>$request->limit,
        ]);
        return redirect()->route('cupon.list');
    }

    public function cupon_status($id){
        $cupon = Cupon::find($id);
        if($cupon->status == 1){
           Cupon::find($id)->update([
            'status'=>0,
           ]);

        }else{
            Cupon::find($id)->update([
                'status'=>1,
            ]);
        }
        return back();
    }

    public function cupon_edit($id){
        $cupon = Cupon::find($id);
        return view('admin.coupon.coupon_update',compact('cupon'));
    }

    public function cupon_update(Request $request, $id){
        Cupon::find($id)->update([
            'coupon'=>$request->cupon,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'validity'=>$request->validity,
            'limit'=>$request->limit,
        ]);
        return redirect()->route('cupon.list');
    }

    public function cupon_delete($id){
        Cupon::find($id)->delete();
        return back();

    }
}
