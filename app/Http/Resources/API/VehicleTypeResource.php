<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $display_name
 * @property mixed $vehicleModels
 */
class VehicleTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "display_name" => $this->display_name,
            "models" => VehicleModelResource::collection($this->whenLoaded('VehicleModels')),
        ];
    }
}
