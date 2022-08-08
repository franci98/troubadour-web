<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * @OA\Post (
     *      path="/games",
     *      tags={"Game"},
     *      security={{"bearerAuth":{}}},
     *      summary="New game",
     *      description="Create a new game.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/GameCreateRequest")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Game was successfuly created. The game details are returned.",
     *          @OA\JsonContent(ref="#/components/schemas/GameResource")
     *       ),
     * )
     */
    public function store(Request $request)
    {
        //$this->authorize('create', Game::class);
        $data = $request->validate([
            'difficulty_id' => 'required|exists:difficulties,id',
            'game_type_id' => 'required|exists:game_types,id'
        ]);

        $game = Game::query()->create($data);
        $gameUser = $game->gameUsers()->create([
            'user_id' => auth()->id(),
        ]);
        $game->createExercises();

        return GameResource::make($game);
    }

    /**
     * @OA\Get (
     *     path="/games/{id}",
     *     tags={"Game"},
     *     security={{"bearerAuth":{}}},
     *     summary="Game details",
     *     description="Get game details.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Game id"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Game details object is returned.",
     *         @OA\JsonContent(ref="#/components/schemas/GameResource")
     *     ),
     * )*/
    public function show(Request $request, Game $game)
    {
        //$this->authorize('view', $game);
        return GameResource::make($game);
    }
}
