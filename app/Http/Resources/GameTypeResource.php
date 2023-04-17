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

    /**
     * @OA\Property(
     *      title="deleted_at",
     *      description="Time of game type soft deletion",
     *      example="2023-03-15 10:00:00"
     * )
     */
    public $deleted_at;

      /**
     * @OA\Property(
     *      title="mobile_only",
     *      description="Whether game should be available only on mobile devices.",
     *      example="False"
     * )
     */
    public $mobile_only;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'deleted_at' => $this->resource->deleted_at,
            'mobile_only' => $this->resource->mobile_only,
            'image_url' => $this->getImageUrl(),
        ];
    }

    public function getImageUrl() {
        if (file_exists(public_path().'/img/game-types/' . $this->resource->id . '.svg')) {
            return url('/img/game-types/' . $this->resource->id . '.svg');
        }
        return url('/img/game-types/empty.svg');
    }
}
