<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function user_update(){
        return view('admin.user.profile');
    }

    public function user_info_update(Request $request){
        User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        return back()->with('status','User Updated !!');
    }

    public function password_update(UserRequest $request){

        // $request->validate([
        //     'current_password'=>'required',
        //     'password'=>'required',
        //     'password_confirmation'=>'required'
        // ],[
        //     'current_password.required'=>'Current Password Dao',
        //     'password.required'=>'New Password Dao',
        //     'password_confirmation.required'=>'Password Confirm Koro'
        // ]);

        $user = User::find(Auth::id());
        if(Hash::check($request->current_password,$user->password)){
            User::find(Auth::id())->update([
                'password'=>Hash::make($request->password)
            ]);
            return back()->with('success','Password Updated!!');
        }else{
            return back()->with('invalid','Current Password Wrong!!');
        }

    }
}
