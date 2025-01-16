<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\rules\Password;
// use Illuminate\Support\Facades\Validator;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password'=>'required',
            'password'=>[
                'required',
                'confirmed',
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'current_password.required'=>'Current Password Dao',
            'password.required'=>'New Password Dao',
            'password_confirmation.required'=>'Password Confirm Koro'
        ];
    }
}
