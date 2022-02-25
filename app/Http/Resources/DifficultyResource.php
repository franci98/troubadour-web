<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="Difficulty",
 *      description="Object that represents difficulty.",
 *      type="object",
 * )
 */
class DifficultyResource extends JsonResource
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
     *      description="Value of the difficulty. Can be used to order the difficulties. The easiest has the lowest value.",
     *      example="1"
     * )
     */
    private $value;
    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the difficulty",
     *      example="Very Easy"
     * )
     */
    private $title;
    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the difficulty",
     *      example="Very easy and not very difficult."
     * )
     */
    private $description;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
