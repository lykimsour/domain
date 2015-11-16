<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MerchantRequest extends Request
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
        switch ($this->method()) {
            case 'POST':
            {
                 return [
                'name' => 'required|max:255',
                'password' => 'required|confirmed|min:6',
                'email' => 'required|email|max:255|unique:merchants',
                'comission' => 'required|between:0,99.99',
                'coin'=> 'required|between:0,99.99',
             ];
            }
              case 'PUT':
            {
                 return [
                'name' => 'required|max:255',
                'password' => 'required|confirmed|min:6',
                'email' => 'required|email|max:255|unique:merchants,email,'.$this->id,
                'comission' => 'required|between:0,99.99',
                'coin'=> 'required|between:0,99.99',
             ];
         } 
                default:
                break;
            
    }
     
    }
}
