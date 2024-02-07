<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $display_name
 * @property mixed $estimated_price
 * @property mixed $vehicleType
 * @property mixed $vehicleMarque
 */
class VehicleModelResource extends JsonResource
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
            "estimated_price" => $this->estimated_price,
            "type" => new VehicleTypeResource($this->whenLoaded('VehicleType')),
            "marque" => new VehicleMarqueResource($this->whenLoaded('VehicleMarque')),
        ];
    }
}
