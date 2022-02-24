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
    private $id;
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the supported game type.",
     *      example="Ritmični narek"
     * )
     */
    private $title;
    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the game type.",
     *      example="Vadi ritmični narek."
     * )
     */
    private $description;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
