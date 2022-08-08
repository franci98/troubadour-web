<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

class LevelResource extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'value' => $this->resource->value,
            'title' => $this->resource->title,
            'image_url' => 'TODO',
            'min_rating' => $this->resource->min_rating,
            'max_rating' => $this->resource->max_rating,
        ];

        return $data;
    }
}
