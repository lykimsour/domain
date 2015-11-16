<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OnlineShopItemRequest extends Request
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
         'ordering' => 'integer',
          'name' => 'required|max:255',
          'sku' => 'required|max:255',
          'max' => 'required|integer',
          'value' => 'required|integer',
          'image' => 'image'
        ];
    }
}
