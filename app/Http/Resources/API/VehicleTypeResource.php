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
        $data = [
            "name" => $this->name,
            "display_name" => $this->display_name,
        ];

        if ($request->has('include') && str_contains($request->get('include'), 'models')) {
            $request->merge(['include' => str_replace('models', '', $request->get('include'))]);
            $data['models'] = VehicleModelResource::collection($this->vehicleModels);
        }

        return $data;
    }
}
