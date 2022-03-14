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
        $game->createExercises();

        return GameResource::make($game);
    }
}
