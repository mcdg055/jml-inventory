<?php

namespace App\Http\Requests\Supplies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplyItemQuantityRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quantity' => "required|min:1"
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            "quantity.required" => "Please enter quantity",
            "quantity.min" => "Minimum value is 1",
        ];
    }
}
