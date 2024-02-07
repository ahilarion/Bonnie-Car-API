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
        $data = [
            "name" => $this->name,
            "display_name" => $this->display_name,
            "estimated_price" => $this->estimated_price,
        ];

        if ($request->has('include') && str_contains($request->get('include'), 'types')) {
            $request->merge(['include' => str_replace('types', '', $request->get('include'))]);
            $data['type'] = new VehicleTypeResource($this->vehicleType);
        }

        if ($request->has('include') && str_contains($request->get('include'), 'marques')) {
            $request->merge(['include' => str_replace('marques', '', $request->get('include'))]);
            $data['marque'] = new VehicleMarqueResource($this->vehicleMarque);
        }

        return $data;
    }
}
