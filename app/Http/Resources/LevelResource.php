<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;
/**
    * @OA\Schema(
    *      title="Level",
    *      description="Object that represents level.",
    *      type="object",
    * )
    */
class LevelResource extends JsonResource
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Unique identifier",
     *      example="1"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *      title="value",
     *      description="Value of the level",
     *      example="1"
     * )
     */
    private $value;

    /**
     * @OA\Property(
     *      title="completion_percentage",
     *      description="Percentage of completion of the level",
     *      example="0.5"
     * )
     */
    private $completion_percentage;

    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'value' => $this->resource->value,
            'title' => $this->resource->title,
            'image_url' => url('/img/levels/' . $this->resource->id . '.svg'),
            'min_rating' => $this->resource->min_rating,
            'max_rating' => $this->resource->max_rating,
        ];

        if (auth()->check()) {
            $data['completion_percentage'] = $this->resource->completionPercentageFor(auth()->user());
        }

        return $data;
    }
}
