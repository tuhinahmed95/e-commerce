<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cupon;
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
        return back()->with('cart_add', 'Cart Added');
    }

    public function cart_remove($id)
    {
        Cart::find($id)->delete();
        return back();
    }

    public function cart(Request $request)
    {

        $cupon = $request->cupon;

        $msg = '';
        $type = '';
        $amount = 0;

        if($cupon){
            if (Cupon::where('coupon', $cupon)->exists()) {
                if (Cupon::where('coupon', $cupon)->where('limit', '!=', 0)->exists()) {
                    if(Carbon::now()->format('Y-m-d') <= Cupon::where('coupon', $cupon)->first()->validity){
                        $type = Cupon::where('coupon', $cupon)->first()->type;
                        $amount = Cupon::where('coupon', $cupon)->first()->amount;
                    }else{
                        $msg = 'Cupon Expired';
                        $amount = 0;
                    }
                } else {
                    $msg = 'Cupon Limit Exceed';
                    $amount = 0;
                }
            } else {
                $msg = 'Cupon Does Not Exist';
                $amount = 0;
            }
        }

        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.cart', compact('carts', 'msg', 'type', 'amount'));
    }

    public function cart_update(Request $request)
    {
        foreach ($request->quantity as $cart_id => $quantity) {
            Cart::find($cart_id)->update([
                'quantity' => $quantity,
            ]);
        }
        return back();
    }
}
