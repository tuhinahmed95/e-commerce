<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }
    public function user_list(){
        $users = User::where('id','!=',Auth::id())->get();
        return view('admin.user.userlist',compact('users'));
    }

}
