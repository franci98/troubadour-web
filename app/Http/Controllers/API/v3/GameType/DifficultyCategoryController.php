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
     * @API\Get(
     *     path="/api/v3/game-types/{gameType}/difficulty-categories",
     *     summary="Get all difficulty categories for a game type",
     *     description="Get all difficulty categories for a game type",
     *     tags={"Game Types"},
     *     @API\Parameter(
     *     name="gameType",
     *     in="path",
     *     description="Game Type ID",
     *     required=true,
     *     @API\Schema(
     *     type="integer",
     *     format="int"
     *    )
     *   ),
     *     @API\Response(
     *     response=200,
     *     description="Success",
     *     @API\JsonContent(
     *     type="array",
     *     @API\Items(ref="#/components/schemas/DifficultyCategory")
     *   )
     *  )
     * )
     */
    public function index(Request $request, GameType $gameType)
    {
        return DifficultyCategoryResource::collection($gameType->difficultyCategories);
    }
}
