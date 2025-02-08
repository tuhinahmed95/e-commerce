<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class CustomerAuthController extends Controller
{
    public function customer_login()
    {
        return view('frontend.customer.login');
    }

    public function customer_register()
    {
        return view('frontend.customer.register');
    }

    public function customer_store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required|unique:customers',
            'password' => 'required',
            // 'current_password:api' => 'required'
        ]);

        Customer::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Customer Registered Successfully');
    }

    public function customer_logged(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Customer::where('email', $request->email)->exists()) {
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('index');
            } else {
                return back()->with('wrong', 'Wrong Password');
            }
        } else {
            return back()->with('exist', 'Email Does Not Exist');
        }
    }

    public function githubredirect_login(){
        return Socialite::driver('github')->redirect();
    }

    public function githubcallback_login(){
        $githubUser = Socialite::driver('github')->user();
        $user = Customer::updateOrCreate([
            'email' =>  $githubUser->email,
        ]
        ,[
            'fname' => $githubUser->name,
            'lname' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => Hash::make(12345),
            'created_at' => Carbon::now(),
        ]);

        Auth::guard('customer')->attempt(['email' =>$githubUser->email, 'password' => 12345]);
        return redirect()->route('index');
    }

    function googleredirect_login()
    {
        return Socialite::driver('google')->redirect();
    }
    function googlecallback_login()
    {
        $googleUser  = Socialite::driver('google')->user();
        Customer::updateOrCreate(
            [
                'email' => $googleUser->email,
            ],
            [
                'fname' => $googleUser->name,
                'lname' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(123456),
                'created_at' => Carbon::now(),
            ]
        );

        Auth::guard('customer')->attempt(['email' => $googleUser->email, 'password' => 12345]);
        return redirect()->route('index');
    }
}
