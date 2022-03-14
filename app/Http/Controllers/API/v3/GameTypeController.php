<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameTypeResource;
use App\Models\GameType;
use Illuminate\Http\Request;

class GameTypeController extends Controller
{
    /**
     * @OA\Get (
     *      path="/game-types",
     *      tags={"GameType","Game"},
     *      security={{"bearerAuth":{}}},
     *      summary="Game Types List",
     *      description="Retrieve all game types the platform currently offers.",
     *      @OA\Response(
     *          response=200,
     *          description="Successfuly retrieved the list",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/GameTypeResource"))
     *          )
     *       ),
     * )
     */
    public function index()
    {
        return GameTypeResource::collection(GameType::all());
    }
}
