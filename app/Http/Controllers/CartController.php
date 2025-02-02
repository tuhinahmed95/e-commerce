<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
        ]);
        Cart::insert([
            'customer_id' => Auth::guard('customer')->id(),
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('cart_add','Cart Added');
    }

    public function cart_remove($id){
        Cart::find($id)->delete();
        return back();
    }

    public function cart(){
        $carts = Cart::where('customer_id',Auth::guard('customer')->id())->get();
        return view('frontend.cart',compact('carts'));
    }

    public function cart_update(Request $request){
       foreach($request->quantity as $cart_id => $quantity){
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
            ]);

       }
       return back();

    }
}
