<?php

namespace App\Http\Requests\PassOut;

use App\Models\InventoryItem;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePassOutItemRequest extends FormRequest
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
        $inputs = $this->request->all();

        return [
            'id' => 'required',
            'quantity' => "required|numeric|min:1|lte:" . $inputs['inventory_item']['stock'],
        ];
    }

    public function messages()
    {
        $inputs = $this->request->all();

        return [
            'quantity.required' => "Quantity is required",
            'quantity.min' => "Minimum quantity is 1",
            'quantity.lte' => "Must not exceed {$inputs['inventory_item']['stock']} items.",
        ];
    }
}
