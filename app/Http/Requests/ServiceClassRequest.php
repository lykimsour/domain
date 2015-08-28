<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServiceClassRequest extends Request
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
            'name' => 'required|max:45',
            'commissionrate' => 'required|between:0,99.99',
            'payoutrate' => 'required|between:0,99.99'
        ];
    }
}
