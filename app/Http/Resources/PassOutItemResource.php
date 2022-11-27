<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassOutItemResource extends JsonResource
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
            'inventory_item' => new InventoryItemResource($this->whenLoaded('inventory_item')),
            'pass_out_id' => $this->pass_out_id,
            'quantity' => $this->quantity,
            'subtotal'=>$this->subtotal,
        ];
    }
}
