<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'images' => $this->images,
            'user_uuid' => $this->user_uuid,
            'vehicle_uuid' => $this->vehicle_uuid,
            'published_at' => $this->published_at,
        ];
    }
}
