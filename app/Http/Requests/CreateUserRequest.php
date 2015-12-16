<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
      'name'  =>  'required',
      'email' =>  'required|unique:users',
      'mobile'  =>  ['required','regex:/^[789]\d{9}$/'],
      'password'  =>  'required|min:6'    
    ];
  }

  public function messages() {
    return [
      'name.required' =>  'Name is Required',
      'email.required'  =>  'Email is Required',
      'email.unique'    =>  'Email Already Registered',
      'password.required' =>  'Password is Required',
      'password.min'      =>  'Password Min Length: 6',
      'mobile.required'   =>  'Mobile No is Required',
      'mobile.regex'    =>  'Invalid Mobile Number'
    ];    
  }
}
