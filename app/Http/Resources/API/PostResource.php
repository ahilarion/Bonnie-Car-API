<?php

namespace App\Http\Resources\API;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $display_name
 * @property mixed $vehiclePost
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "description" => $this->description,
            "images" => json_decode($this->images),
            "price" => $this->price,
            "kilometer" => $this->kilometer,
            "vehicle_model" => $this->vehicle_model,
            "vehicle_marque" => $this->vehicle_marque,
            "vehicle_type" => $this->vehicle_type,
            // "user" => User::collection($this->whenLoaded('User')),
        ];
    }
}