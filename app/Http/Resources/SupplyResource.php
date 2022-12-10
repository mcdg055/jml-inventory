<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplyResource extends JsonResource
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
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString(),
            'number' => $this->number,
            'notes' => $this->notes,
            'supply_items' => SupplyItemResource::collection($this->whenLoaded('supply_items')),
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'receiver' => new UserResource($this->whenLoaded('receiver')),
        ];
    }
}
