<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name' => 'required',
            'contact_person' => 'required|regex:/^[\pL\s\-]+$/u',
            'contact_number' =>  'phone:PH',
            'is_active' => '',
        ];
    }

    public function messages()
    {
        return [
            'contact_number.phone' => "Invalid contact number"
        ];
    }
}
