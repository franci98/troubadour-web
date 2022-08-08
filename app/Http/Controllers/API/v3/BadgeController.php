<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\BadgeResource;
use App\Models\Badge;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BadgeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/badges",
     *      tags={"Badges"},
     *      security={{"bearerAuth":{}}},
     *      summary="Badges list",
     *      description="Returns an array of all badges the user can or has achieved.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful response",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      )
     * )
     */
    public function index()
    {
        return BadgeResource::collection(Badge::all());
    }
}
