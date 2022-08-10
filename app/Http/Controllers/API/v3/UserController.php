<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameUserResource;
use App\Models\GameUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users/leaderboard",
     *     tags={"Users"},
     *     summary="Get leaderboard",
     *     description="Returns the leaderboard",
     *     parameters={
     *     {
     *     "name"="game_type_id",
     *     "in"="query",
     *     "description"="Return leaderboard for a specific game type",
     *     "required"=false,
     *     }
     *     },
     *     @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/GameUserResource")
     *     ),
     *     )
     * )
     */
    public function leaderboard(Request $request)
    {
        if ($request->has('game_type_id')) {
            $game_type_id = $request->game_type_id;
            $sortedLeaderboard = GameUser::query()
                ->select('game_user.*', DB::raw('SUM(game_user.points) AS points'))
                ->whereHas('game', function ($query) use ($game_type_id) {
                    $query->where('game_type_id', $game_type_id);
                })
                ->groupBy('user_id')
                ->orderBy('points')
                ->get();
        } else {
            $sortedLeaderboard = GameUser::query()
                ->select('game_user.*', DB::raw('SUM(game_user.points) AS points'))
                ->groupBy('user_id')
                ->get();
        }

        return GameUserResource::collection($sortedLeaderboard);
    }
}
