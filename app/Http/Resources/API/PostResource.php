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
            "vehicle_model_name" => $this->vehicle_model_name,
            // "user" => User::collection($this->whenLoaded('User')),
        ];
    }
}