<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Intervention\Image\Facades\image;

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

    public function photo_update(Request $request){
        //return $request->all();
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if(Auth::user()->photo != Null){
            $delete_from = public_path('uploads/user/'.Auth::user()->photo);
            unlink($delete_from);
        }

        $photo = $request->photo;
        $exten = $photo->extension();
        $file_name = Auth::id().'.'.$exten;
        $photo->move(public_path('uploads/user'), $file_name);
        User::find(Auth::id())->update([
            'photo'=> $file_name,
        ]);
        return back()->with('photo','successfully Your profile photo updated');

    }

}
