<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserWagerRequest extends FormRequest
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
            'total_wager_value' => 'required|min:0',
            'odds' => 'required|min:0',
            'selling_percentage' => 'required|min:1|max:100',
            'selling_price' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'total_wager_value.required' => 'total_wager_value is required!',
            'odds.required' => 'odds is required!',
            'selling_percentage.required' => 'selling_percentage is required!',
            'selling_price.required'=>'selling_price is required!'
        ];
    }
}
