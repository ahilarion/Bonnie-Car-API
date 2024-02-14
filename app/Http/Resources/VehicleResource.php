<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $description
 * @property mixed $condition
 * @property mixed $vehicle_length
 * @property mixed $seats
 * @property mixed $number_of_doors
 * @property mixed $color
 * @property mixed $kilometers
 * @property mixed $number_of_owners
 * @property mixed $technical_revision
 * @property mixed $circulation_date
 * @property mixed $production_year
 * @property mixed $year_of_manufacture
 * @property mixed $torque
 * @property mixed $power
 * @property mixed $cylinder_capacity
 * @property mixed $transmission
 * @property mixed $energy_source
 * @property mixed $type
 * @property mixed $original_price
 * @property mixed $model
 * @property mixed $constructor
 * @property mixed $uuid
 */
class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'constructor' => $this->constructor,
            'model' => $this->model,
            'original_price' => $this->original_price,
            'type' => $this->type,
            'energy_source' => $this->energy_source,
            'transmission' => $this->transmission,
            'cylinder_capacity' => $this->cylinder_capacity,
            'power' => $this->power,
            'torque' => $this->torque,
            'year_of_manufacture' => $this->year_of_manufacture,
            'production_year' => $this->production_year,
            'circulation_date' => $this->circulation_date,
            'technical_revision' => $this->technical_revision,
            'number_of_owners' => $this->number_of_owners,
            'kilometers' => $this->kilometers,
            'color' => $this->color,
            'number_of_doors' => $this->number_of_doors,
            'seats' => $this->seats,
            'vehicle_length' => $this->vehicle_length,
            'condition' => $this->condition,
            'description' => $this->description,
        ];
    }
}
