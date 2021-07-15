<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "manufacturer_id" => $this->manufacturer->id,
            "manufacturer" => new ManufacturerResource($this->manufacturer),
            "name" => $this->name,
        ];
    }
}
