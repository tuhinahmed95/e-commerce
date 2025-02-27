<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function dashboard(){
        // for orders
       $orders = Order::where('order_date','>', Carbon::now()->subDays(7))
                ->groupBy('order_date')->selectRaw('count(*) as total,order_date')->get();

       $total_order = '';
       $order_date = '';
       foreach($orders as $order){
            $total_order .= $order->total.',';
            $order_date .= Carbon::parse($order->order_date)->format('d M').',';
       }
       $total_order_info = explode(',',$total_order);
       $order_date_info = explode(',', $order_date);
       array_pop($total_order_info);
       array_pop($order_date_info);
    //    for sales
        $sales = Order::where('order_date','>', Carbon::now()->subDays(7))
                    ->groupBy('order_date')->selectRaw('sum(total) as sum,order_date')->get();

        $total_sales = '';
        $sales_date = '';
        $target = 100000;
        foreach($sales as $sale){
                // $total_sales .= $sale->sum.',';
                $total_sales .=($sale->sum/$target*100).',';
                $sales_date .= Carbon::parse($sale->order_date)->format('d M').',';
        }
        
        $total_sales_info = explode(',',$total_sales);
        $sales_date_info = explode(',', $sales_date);
        array_pop($total_sales_info);
        array_pop($sales_date_info);

       return view('dashboard',compact('total_order_info','order_date_info','total_sales_info','sales_date_info'));
    }
    public function user_list(){
        $users = User::where('id','!=',Auth::id())->get();
        return view('admin.user.userlist',compact('users'));
    }

    public function user_delete($id){
        User::find($id)->delete();
        return back()->with('delete','User Deleted Successfully');
    }

    public function user_ad(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);

        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return back()->with('success','new user added');
    }

}
