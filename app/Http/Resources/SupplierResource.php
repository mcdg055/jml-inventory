<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
        'number'=>$this->number,
        'name'=>$this->name,
        'contact_number'=>$this->contact_number,
        'contact_person'=>$this->contact_person,
        'is_active'=>$this->is_active,
       ];
    }
}
