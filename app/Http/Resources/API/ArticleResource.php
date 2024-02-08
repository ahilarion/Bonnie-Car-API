<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "thumbnail"=> $this->thumbnail,
            "description"=> $this->description,
            "short_description" => $this->short_description,
            "html_content"=> $this->html_content,
            "banner"=> $this->banner,
            "tags"=> $this->tags
        ];
    }
}
