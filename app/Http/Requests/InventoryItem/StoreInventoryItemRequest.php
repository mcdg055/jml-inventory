<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryItemRequest extends FormRequest
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
            "name" => "required",
            "brand_id" => "required|numeric",
            "unit_price" => "required|numeric",
            "stock" => "numeric",
            "is_active" => "",
            "critical_level" => "required|numeric",
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => "Please select a brand above.",
            'brand_id.numeric' => "Please select a brand above.",
        ];
    }
}
