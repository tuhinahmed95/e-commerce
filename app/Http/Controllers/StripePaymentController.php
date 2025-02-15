<?php

namespace App\Http\Controllers;

use App\Models\Stripe as ModelsStripe;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Sslorder;
use App\Models\Billing;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;



class StripePaymentController extends Controller

{

    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripe()

    {
        $data = session('data');
        $check_val = '';
        if(empty($data['shif_check'])){
            $check_val = 0;
        }
        else{
            $check_val = 1;
        }

        $total = $data['total']+ $data['charge'];
        
        $stripe_id = ModelsStripe::insertGetId([
            'fname' => $data['fname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'total' => $total,
            'address' => $data['address'],
            'lname' => $data['lname'],
            'country' => $data['country'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'company' => $data['company'],
            'notes' => $data['notes'],
            'shif_fname' => $data['shif_fname'],
            'shif_lname' => $data['shif_lname'],
            'shif_country' => $data['shif_country'],
            'shif_city' => $data['shif_city'],
            'shif_zip' => $data['shif_zip'],
            'shif_company' => $data['shif_company'],
            'shif_email' => $data['shif_email'],
            'shif_phone' => $data['shif_phone'],
            'shif_address' => $data['shif_address'],
            'charge' => $data['charge'],
            'discount' => $data['discount'],
            'shif_check' => $check_val,
            'customer_id' => $data['customer_id'],
        ]);
        return view('stripe',[
            'stripe_id'=>$stripe_id,
            'total'=>$total,
        ]);

    }



    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)

    {
        $data = ModelsStripe::find($request->stripe_id);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create ([

                "amount" => 100 * $data->total,
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."

        ]);

        $order_id = '#'.uniqid().'-'.Carbon::now()->format('d-m-Y');
        if($data->ship_check == 1){
            Order::insert([
                'order_id'=>$order_id,
                'customer_id'=>$data->customer_id,
                'total'=>$data->total,
                'sub_total'=>$data->total+$data->discount-($data->charge),
                'discount'=>$data->discount,
                'charge'=>$data->charge,
                'payment_method'=>3,
                'created_at'=>Carbon::now(),
            ]);

            Billing::insert([
                'order_id' => $order_id,
                'customer_id' => $data->customer_id,
                'fname' => $data->fname,
                'lname' => $data->lname,
                'country_id' => $data->country,
                'city_id' => $data->city,
                'zip' => $data->zip,
                'company' => $data->company,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'notes' => $data->notes,
                'created_at' => Carbon::now(),
            ]);

            Shipping::insert([
                'order_id' => $order_id,
                'shif_fname' => $data->shif_fname,
                'shif_lname' => $data->shif_lname,
                'shif_country_id' => $data->shif_country,
                'shif_city_id' => $data->shif_city,
                'shif_zip' => $data->shif_zip,
                'shif_company' => $data->shif_company,
                'shif_email' => $data->shif_email,
                'shif_phone' => $data->shif_phone,
                'shif_address' => $data->shif_address,
                'created_at' => Carbon::now(),
            ]);
        }

        else{
            Order::insert([
                'order_id'=>$order_id,
                'customer_id'=>$data->customer_id,
                'total'=>$data->total,
                'sub_total'=>$data->total+$data->discount-($data->charge),
                'discount'=>$data->discount,
                'charge'=>$data->charge,
                'payment_method'=>3,
                'created_at'=>Carbon::now(),
            ]);

            Billing::insert([
                'order_id' => $order_id,
                'customer_id' => $data->customer_id,
                'fname' => $data->fname,
                'lname' => $data->lname,
                'country_id' => $data->country,
                'city_id' => $data->city,
                'zip' => $data->zip,
                'company' => $data->company,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'notes' => $data->notes,
                'created_at' => Carbon::now(),
            ]);

            Shipping::insert([
                'order_id' => $order_id,
                'shif_fname' => $data->name,
                'shif_lname' => $data->lname,
                'shif_country_id' => $data->country,
                'shif_city_id' => $data->city,
                'shif_zip' => $data->zip,
                'shif_company' => $data->company,
                'shif_email' => $data->email,
                'shif_phone' => $data->phone,
                'shif_address' => $data->address,
                'created_at' => Carbon::now(),
            ]);
        }

        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        foreach($carts as $cart){
            OrderProduct::insert([
                'order_id'=>$order_id,
                'customer_id' => $data->customer_id,
                'product_id' => $cart->product_id,
                'price' => $cart->rel_to_product->after_discount,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'created_at' => Carbon::now(),
            ]);

            // Cart::find($cart->id)->delete();
            Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
        }

        Mail::to($data->email)->send(new InvoiceMail($order_id));
        return redirect()->route('order.success')->with('success', $order_id);

    }

}
