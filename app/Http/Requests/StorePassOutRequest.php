<?php

namespace App\Http\Requests;

use App\Models\InventoryItem;
use Illuminate\Foundation\Http\FormRequest;

class StorePassOutRequest extends FormRequest
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

        $rules = [];

        $inputs = $this->request->all();

        $rules['short_description'] = 'required';
        $rules['notes'] = '';
        if ($selected_items = $inputs["selected_items"]) {
            foreach ($selected_items as $key => $value) {
                $inventory_item = InventoryItem::find($value['id']);
                $rules['selected_items.' . $key . '.quantity'] = "required|numeric|min:1|lte:" . $inventory_item->stock;
                $rules['selected_items.' . $key . '.id'] = "";
            }
        } else {
            $rules['selected_items'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        $messages['short_description.required'] = 'Please enter short description.';
        $inputs = $this->request->all();
        if ($selected_items = $inputs["selected_items"]) {
            foreach ($selected_items as $key => $value) {
                $inventory_item = InventoryItem::find($value['id']);
                $messages['selected_items.' . $key . '.quantity.min']  = "Minimum quantity is 1";
                $messages['selected_items.' . $key . '.quantity.required']  = "Quantity is required";
                $messages['selected_items.' . $key . '.quantity.lte']  = "Must not exceed {$inventory_item->stock} items.";
            }
        } else {
            $rules['selected_items.required'] = 'Please select pass out item/s.';
        }

        return $messages;
    }
}
