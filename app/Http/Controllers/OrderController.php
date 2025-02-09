<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCancel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(){
        $orders = Order::latest()->get();
        return view('admin.order.order',compact('orders'));
    }

    public function orders_status_update(Request $request,$id){
       Order::find($id)->update([
        'status' => $request->status,
       ]);
       return back();
    }

    public function order_cancel($id){
        $orders = Order::find($id);
        return view('frontend.customer.order_cancel', compact('orders'));
    }

    public function order_cancel_request(Request $request, $id){
        $request->validate([
            'reson'=>'required',
            'image'=>'nullable'
        ]);

        if($request->image == ''){
            OrderCancel::insert([
                'order_id' =>$id,
                'reson' =>$request->reson
            ]);
            return back()->with('req', 'Order Cancel Request Successfully');
        }
        else{

        }
    }
}
