<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/levels",
     *     tags={"Levels"},
     *     security={{"bearerAuth":{}}},
     *     summary="Levels list",
     *     description="Returns an array of all levels the user can or has achieved.",
     *     @OA\Response(
     *     response=200,
     *     description="Successful response",
     *     @OA\MediaType(
     *     mediaType="application/json",
     *     )
     *    )
     * )
     */
    public function index()
    {
        return LevelResource::collection(Level::all());
    }
}
