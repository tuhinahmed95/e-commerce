<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function user_update(){
        return view('admin.user.profile');
    }

    public function user_info_update(Request $request){
        User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        return back()->with('status','User Updated !!');
    }
}
