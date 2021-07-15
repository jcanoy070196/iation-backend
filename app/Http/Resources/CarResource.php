<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            "model" => new CarModelResource($this->model),
            "color" => new ColorResource($this->color)
        ];
    }
}
