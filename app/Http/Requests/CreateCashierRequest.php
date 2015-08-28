<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
class CreateCashierRequest extends Request
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
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:cashier',
            'password' => 'required|confirmed|min:6',
            'commission' => 'required|between:0,99.99',
            'bonusbalance' => 'integer'
        ];
    }
}
