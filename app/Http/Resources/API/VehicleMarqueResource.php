<?php

namespace App\Http\Resources\API;

use App\Models\API\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\VehicleModelResource;

/**
 * @property mixed $name
 * @property mixed $display_name
 * @property mixed $vehicleModels
 */
class VehicleMarqueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            "name" => $this->name,
            "display_name" => $this->display_name,
        ];

        if ($request->has('include') && str_contains($request->get('include'), 'vehicle_models')) {
            $data['vehicle_models'] = VehicleModelResource::collection($this->vehicleModels);
        }

        return $data;
    }
}
