<?php

namespace App\Http\Controllers\API\v3\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    /**
     * @OA\Get(
     *      path="/classrooms",
     *      tags={"Classrooms"},
     *      security={{"bearerAuth":{}}},
     *      summary="Classrooms list",
     *      description="Returns an array of all classrooms the user can see(depends on role).",
     *      @OA\Response(
     *          response=200,
     *          description="Successful response",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden. Admin access required."
     *      )
     * )
     */
    public function index(Request $request)
    {
        return ClassroomResource::collection(Auth::user()->classrooms);
    }
}
