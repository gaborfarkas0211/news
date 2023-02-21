<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'link' => $this->link,
            'description' => $this->description,
            'published_at' => $this->pubDate,
        ];
    }
}
