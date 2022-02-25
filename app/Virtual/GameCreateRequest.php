<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="GameCreateRequest",
 *      description="Request that is used when a user wants to start a new game.",
 *      type="object",
 *      required={}
 * )
 */
class GameCreateRequest
{
    /**
     * @OA\Property(
     *      title="difficulty_id",
     *      description="Id of the difficulty. The exercises will then be based on this difficulty.",
     *      example="1"
     * )
     */
    private $difficulty_id;

    /**
     * @OA\Property(
     *      title="game_type_id",
     *      description="Id of the game type. The exercises will then be of this type.",
     *      example="1"
     * )
     */
    private $game_type_id;
}
