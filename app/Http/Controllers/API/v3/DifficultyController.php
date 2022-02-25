<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\DifficultyResource;
use App\Models\Difficulty;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{

    /**
     * @OA\Get (
     *      path="/difficulties",
     *      tags={"Game"},
     *      summary="Difficulties List",
     *      description="Retrieve all difficulties the platform currently offers.",
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
    public function index()
    {
        return DifficultyResource::collection(Difficulty::all());
    }
}
