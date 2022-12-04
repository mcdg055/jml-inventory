<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'name' => $this->name,
            'name_with_brand' => $this->name_with_brand,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'unit_price' => $this->unit_price,
            'stock' => $this->stock,
            'critical_level' => $this->critical_level,
            'selected' => $this->selected,
        ];
    }
}
