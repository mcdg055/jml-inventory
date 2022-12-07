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
            'id'=>$this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'notes' => $this->notes,
            'receiver' => new UserResource($this->whenLoaded('receiver')),
        ];
    }
}
