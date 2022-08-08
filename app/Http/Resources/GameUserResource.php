<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="GameUser",
 *      description="GameUser details.",
 *      type="object",
 * )
 */
class GameUserResource extends JsonResource
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
     *      description="Name of the user",
     *      example="John"
     * )
     */
    private $name;

    /**
     * @OA\Property(
     *      title="points",
     *      description="Points of the user",
     *      example="200"
     * )
     */
    private $points;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'points' => $this->resource->points,
        ];
    }
}
