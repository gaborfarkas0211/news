<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsdataResource extends JsonResource
{
    public function toArray($request)
    {
        $results = collect($this->resource['results']);

        return [
            'results' => $results->map(function ($news) use ($request) {
                $newsResource = new NewsResource($news);

                return $request->isJson() ? $newsResource : $newsResource->jsonSerialize();
            }),
            'totalResults' => $this->resource['totalResults'],
            'nextPage' => $this->resource['nextPage']
        ];
    }
}
