<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function customer_profile(){
        return view('frontend.customer.profile');
    }


    public function customer_update(Request $request){
        if ($request->password == '') {
            if ($request->photo == '') {
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'updated'=>Carbon::now(),
                ]);
                return back()->with('cus_update');
            } else {

                $customer_image =  Customer::find(Auth::guard('customer')->id())->photo;
                unlink($customer_image);

                if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $image_path = 'uploads/customer/' . $image_name;
                    $image->move(public_path('uploads/customer/'), $image_name);
                }

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'photo' => $image_path,
                    'updated'=>Carbon::now(),
                ]);
                return back()->with('cus_update');
            }
        }else{
            if ($request->photo == '') {
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'password'=>Hash::make($request->password),
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'updated'=>Carbon::now(),
                ]);
                return back()->with('cus_update');
            } else {

                $customer_image =  Customer::find(Auth::guard('customer')->id())->photo;
                unlink($customer_image);

                if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $image_path = 'uploads/customer/' . $image_name;
                    $image->move(public_path('uploads/customer/'), $image_name);
                }

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'password'=>Hash::make($request->password),
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'photo' => $image_path,
                    'updated'=>Carbon::now(),
                ]);
                return back()->with('cus_update');
            }
        }
    }

    public function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('index')->with('customer','You Are Logged Out');
    }

    public function customer_order(){
        $my_orders = Order::where('customer_id', Auth::guard('customer')->id())->latest()->get();
        return view('frontend.customer.myorder',compact('my_orders'));
    }

    public function download_invoice($id){
        $orders = Order::find($id);

        $pdf = PDF::loadview('frontend.customer.invoicedownload',[
            'order_id'=>$orders->order_id,
        ]);
        return $pdf->download('myorders.pdf');
    }
}
