<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(empty(Auth::check()))
        {
            return [
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required|email|unique:users,email',
                'phone_number'    => 'required',
                'street_address'  => 'required',
                'country'   => 'required',
                'state'     => 'required',
                'city'      => 'required',
                'pin_code'  => 'required',
            ];
        }   
        else
        {
            return [
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required',
                'phone_number'    => 'required',
                'street_address'  => 'required',
                'country'   => 'required',
                'state'     => 'required',
                'city'      => 'required',
                'pin_code'  => 'required',
            ];    
        }
        
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email address already registered please login your account and place order',
        ];
    }
}
