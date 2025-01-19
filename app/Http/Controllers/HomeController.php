<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
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
