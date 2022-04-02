<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="GameType",
 *      description="Game type object that describes an available game type.",
 *      type="object",
 *      required={"title","description"}
 * )
 */
class GameTypeResource extends JsonResource
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Unique identifier.",
     *      example="1"
     * )
     */
    public $id;
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the supported game type.",
     *      example="Ritmični narek"
     * )
     */
    public $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the game type.",
     *      example="Vadi ritmični narek."
     * )
     */
    public $description;

    /**
     * @OA\Property(
     *      title="image_url",
     *      description="Url to the icon.",
     *      example="http://localhost:8000/img/game-types/1.svg"
     * )
     */
    public $image_url;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'image_url' => url('/img/game-types/' . $this->resource->id . '.svg'),
        ];
    }
}
