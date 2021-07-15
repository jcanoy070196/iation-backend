<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarModelBasicResource extends JsonResource
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
            "manufacturer" => $this->manufacturer->name,
            "name" => $this->name,
        ];
    }
}
