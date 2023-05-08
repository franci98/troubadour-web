<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
     *      title="sequence",
     *      description="Sequence of the difficulty. Can be used to order the difficulties. The easiest has the lowest value.",
     *      example="1"
     * )
     */
    private $sequence;
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

    /**
     * @OA\Property(
     *      title="points",
     *      description="Points the user retrieved on this difficulty.",
     *      example="1000"
     * )
     */
    private $points;

    /**
     * @OA\Property(
     *      title="number_of_games",
     *      description="Number of games the user played on this difficulty.",
     *      example="20"
     * )
     */
    private $number_of_games;


    /**
     * @OA\Property(
     *      title="deleted at",
     *      description="Time of difficulty soft deleted.",
     *      example="2023-03-15 10:00:00"
     * )
     */
    private $deleted_at;


    /**
     * @OA\Property(
     *      title="max_game",
     *      description="Numbere of games for this difficulty",
     *      example=1"2"
     * )
     */
    private $max_games;

    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'sequence' => $this->resource->sequence,
            'title' => $this->resource->title,
            'image_url' => 'todo',
            'description' => $this->resource->description,
            'deleted_at' => $this->resource->deleted_at,
            'max_games' => $this->resource->max_games,
        ];
        if (Auth::check()) {
            $data['points'] = $this->resource->getPointsForUser(Auth::user());
            $data['number_of_games'] = $this->resource->getNumberOfGamesForUser(Auth::user());
         }

        return $data;
    }
}
