<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarBasicResource extends JsonResource
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
            "model_id" => $this->model->id,
            "color_id" => $this->color->id,
            "model" => $this->model->name,
            "manufacturer" => $this->model->manufacturer->name,
            "color" => $this->color->name,
            "name" => $this->name
        ];
    }
}
