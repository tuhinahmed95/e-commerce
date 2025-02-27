<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $countries = Country::all();
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.checkout', compact('carts', 'countries'));
    }

    public function getCity(Request $request)
    {
        $str = '';
        $cities =  City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $str .= '<option value="' . $city->id . '">' . $city->name . ' </option>';
        }
        echo $str;
    }

    public function order_store(Request $request)
    {
        if ($request->payment_method == 1) {
            $order_id = '#' . uniqid() . 'D- ' . Carbon::now()->format('d-m-y');
            if ($request->shif_check == 1) {
                $request->validate([
                    'shif_fname'=>'required',
                    'shif_lname'=>'required',
                    'shif_zip'=>'required',
                    'shif_company'=>'required',
                    'shif_email'=>'required',
                    'shif_phone'=>'required',
                ]);

                Order::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'total' => $request->total + $request->charge,
                    'sub_total' => $request->total - $request->discount,
                    'discount' => $request->discount,
                    'charge' => $request->charge,
                    'payment_method' => $request->payment_method,
                    'order_date' => Carbon::now()->formate('y-m-d'),
                    'created_at' => Carbon::now(),
                ]);

                Billing::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'country_id' => $request->country,
                    'city_id' => $request->city,
                    'zip' => $request->zip,
                    'company' => $request->company,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'notes' => $request->notes,
                    'created_at' => Carbon::now(),
                ]);

                Shipping::insert([
                    'order_id' => $order_id,
                    'shif_fname' => $request->shif_fname,
                    'shif_lname' => $request->shif_lname,
                    'shif_country_id' => $request->shif_country,
                    'shif_city_id' => $request->shif_city,
                    'shif_zip' => $request->shif_zip,
                    'shif_company' => $request->shif_company,
                    'shif_email' => $request->shif_email,
                    'shif_phone' => $request->shif_phone,
                    'shif_address' => $request->shif_address,
                    'created_at' => Carbon::now(),
                ]);
            }
            else {

                Order::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'total' => $request->total + $request->charge,
                    'sub_total' => $request->total - $request->discount,
                    'discount' => $request->discount,
                    'charge' => $request->charge,
                    'payment_method' => $request->payment_method,
                    'created_at' => Carbon::now(),
                ]);

                Billing::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'country_id' => $request->country,
                    'city_id' => $request->city,
                    'zip' => $request->zip,
                    'company' => $request->company,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'notes' => $request->notes,
                    'created_at' => Carbon::now(),
                ]);

                Shipping::insert([
                    'order_id' => $order_id,
                    'shif_fname' => $request->fname,
                    'shif_lname' => $request->lname,
                    'shif_country_id' => $request->country,
                    'shif_city_id' => $request->city,
                    'shif_zip' => $request->zip,
                    'shif_company' => $request->company,
                    'shif_email' => $request->email,
                    'shif_phone' => $request->phone,
                    'shif_address' => $request->address,
                    'created_at' => Carbon::now(),
                ]);
            }

            $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
            foreach($carts as $cart){
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $cart->product_id,
                    'price' => $cart->ret_to_product->after_discount,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);
                // Cart::find($cart->id)->delete();
                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }
            Mail::to($request->email)->send(new InvoiceMail($order_id));
            return redirect()->route('order.success')->with('success',$order_id);

        }
         elseif ($request->payment_method == 2) {
            $data = $request->all();
            return redirect()->route('sslpay')->with('data',$data);
        }
         elseif ($request->payment_method == 3) {
            $data = $request->all();
            return redirect()->route('stripe')->with('data',$data);
        }
    }

    public function order_success(){
        if(session('success')){
            return view('frontend.order_success');
        }
        else{
            abort('404');
        }
    }
}
