<?php

namespace App\Http\Requests\Supplies;

use App\Models\InventoryItem;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupplyRequest extends FormRequest
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

        $rules = [];

        $rules['supplier'] =  'required';
        $rules['notes'] =  '';

        if ($selected_items = $inputs["items"]) {
            foreach ($selected_items as $key => $value) {
                $rules['items.' . $key . '.quantity'] = "required|numeric|min:1|";
                $rules['items.' . $key . '.id'] = "";
            }
        } else {
            $rules['items'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [];
        $messages['supplier'] = 'Please select a supplier';
        $inputs = $this->request->all();
        if ($selected_items = $inputs["items"]) {
            foreach ($selected_items as $key => $value) {
                $messages['items.' . $key . '.quantity.min']  = "Minimum quantity is 1";
                $messages['items.' . $key . '.quantity.required']  = "Quantity is required";
            }
        } else {
            $messages['items.required'] = 'Please select supply item/s.';
        }

        return $messages;
    }
}
