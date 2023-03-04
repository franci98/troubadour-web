<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="Difficulty Category",
 *      description="Object that represents difficulty category.",
 *      type="object",
 * )
 */
class DifficultyCategoryResource extends JsonResource
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
     *      title="name",
     *      description="Name of the difficulty category",
     *      example="Easy"
     * )
     */
    private $name;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the difficulty category",
     *      example="Easy and not very difficult."
     * )
     */
    private $description;

    /**
     * @OA\Property(
     *      title="sequence",
     *      description="Sequence of the difficulty category. Can be used to order the difficulty categories. The easiest has the lowest value.",
     *      example="1"
     * )
     */
    private $sequence;


    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'sequence' => $this->resource->sequence,
            'difficulties' => DifficultyResource::collection($this->resource->difficulties),
        ];
    }
}
