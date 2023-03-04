<?php

namespace App\Http\Controllers\API\v3\GameType;

use App\Http\Controllers\Controller;
use App\Http\Resources\DifficultyCategoryResource;
use App\Models\Game;
use App\Models\GameType;
use Illuminate\Http\Request;

class DifficultyCategoryController extends Controller
{
    /**
     * @OA\Get (
     *     path="/game-types/{gameTypeId}/difficulty-categories",
     *     tags={"Game"},
     *     security={{"bearerAuth":{}}},
     *     summary="Difficulty Categories List",
     *     description="Retrieve all difficulty categories the platform currently offers.",
     *     @OA\Parameter(
     *     name="gameTypeId",
     *     in="path",
     *     description="Game Type ID",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *     example="1"
     *    )
     *   ),
     *     @OA\Response(
     *     response=200,
     *     description="Successfuly retrieved the list",
     *     @OA\JsonContent(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/DifficultyCategoryResource"))
     *    )
     * ),
     * )
     */
    public function index(Request $request, GameType $gameType)
    {
        return DifficultyCategoryResource::collection($gameType->difficultyCategories);
    }
}
