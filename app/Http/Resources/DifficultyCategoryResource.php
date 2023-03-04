<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DifficultyCategoryResource extends JsonResource
{



    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sequence' => $this->sequence,
            'difficulties' => DifficultyResource::collection($this->difficulties),
        ];
    }
}
