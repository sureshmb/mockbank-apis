<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SocialLoginRequest extends Request
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
        return [
            'access_token'  =>  'required',
            'user_id'       =>  'required',
            'provider'      =>  'required|in:facebook,google'
        ];
    }

    public function messages() {
        return [
            'access_token.required'     =>  'Access Token Missing',
            'user_id.required'          =>  'User Id Missing',
            'provider.required'         =>  'Provider Name Missing',
            'provider.in'               =>  'Only facebook & google are Valid Providers'
        ];        
    }
}
