<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderCancel;
use App\Models\OrderProduct;
use Carbon\Carbon;
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
                'reson' =>$request->reson,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('req', 'Order Cancel Request Successfully');
        }
        else{
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $image-> move('upoads/cancelorder/',$image_name);

                OrderCancel::insert([
                    'order_id'=>$id,
                    'reson'=>$request->reson,
                    'image'=>$image_name,
                    'created_at'=>Carbon::now(),
                ]);
            }
            return back()->with('req', 'Order Cancel Request Successfully');

        }
    }


        public function order_cancel_list(){
        $order_cancel_list = OrderCancel::all();
        return view('admin.order.order_cancel',compact('order_cancel_list'));
    }

    public function order_cancel_details($id){
        $cancel_order_detaisl = OrderCancel::find($id);
        return view('admin.order.order_cancel_details',compact('cancel_order_detaisl'));
    }

    public function order_cancel_accept($id){
        $orders = OrderCancel::find($id);
        Order::find($orders->order_id)->update([
            'status' => 5,
        ]);
        $order_id = Order::find($orders->order_id);


        foreach(OrderProduct::where('order_id',$order_id->order_id)->get() as $order_product){
            Inventory::where('product_id',$order_product->product_id)->where('color_id',$order_product->color_id)->where('size_id', $order_product->size_id)->increment('quantity', $order_product->quantity);
         }
        OrderCancel::find($id)->delete();
        return back();

    }


}
