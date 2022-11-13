<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * @OA\Get (
     *      path="/schools",
     *      tags={"School","Authorization"},
     *      summary="Schools List",
     *      description="Retrieve all schools the platform currently offers.",
     *      @OA\Response(
     *          response=200,
     *          description="Successfuly retrieved the list",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/SchoolResource"))
     *          )
     *       ),
     * )
     */
    public function index()
    {
        $schools = School::all();;

        return SchoolResource::collection($schools);
    }
}
