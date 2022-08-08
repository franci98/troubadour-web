<?php

namespace App\Http\Controllers\API\v3\GameType;

use App\Http\Controllers\Controller;
use App\Http\Resources\DifficultyResource;
use App\Models\Difficulty;
use App\Models\GameType;

class DifficultyController extends Controller
{

    /**
     * @OA\Get (
     *      path="/game-types/{gameTypeId}/difficulties",
     *      tags={"Game"},
     *      security={{"bearerAuth":{}}},
     *      summary="Difficulties List",
     *      description="Retrieve all difficulties the platform currently offers.",
     *     @OA\Parameter(
     *     name="gameTypeId",
     *     in="path",
     *     description="Game Type ID",
     *     required=true,
     *     @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successfuly retrieved the list",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/DifficultyResource"))
     *          )
     *       ),
     * )
     */
    public function index(GameType $gameType)
    {
        return DifficultyResource::collection($gameType->difficulties);
    }
}
