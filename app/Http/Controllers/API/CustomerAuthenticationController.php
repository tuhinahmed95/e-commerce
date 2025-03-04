<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CustomerAuthenticationController extends Controller
{
    public function customer_register(Request $request){
        $validator = Validator::make($request->all(),[
            'fname'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }

        if(Customer::where('email',$request->email)->exists()){
            $respones = [
                'error'=>'Customer Email Already Exists',
            ];
        }
        $customers = Customer::create([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        $token = $customers->createToken('testToken')->plainTextToken;
        $respones = [
            'Success'=>'Customer Registered Success',
            'customers'=>$customers,
            'token'=>$token,
        ];
        return response()->json($respones);
    }

    public function customer_login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);
        $customers = Customer::where('email', $request->email)->first();
        if (Customer::where('email', $request->email)->exists()) {
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $token = $customers->createToken('testToken')->plainTextToken;
                $respones = [
                    'Success'=>'Customer Login Success',
                    'email'=>$customers->email,
                    'token'=>$token,
                ];
                 return response()->json($respones);
            }
            else {
                return response([ 'error'=> 'Password Does not match']);
            }
        }
        else {
            return response([ 'error'=> 'Email Does not match']);
        }
    }

    public function customer_logout(Request $request){
        $accesToken = $request->bearerToken;
        $token = PersonalAccessToken::findToken($accesToken);
        $token->delete();
        return response([ 'message'=> 'Customer Logout Success']);
    }
}
