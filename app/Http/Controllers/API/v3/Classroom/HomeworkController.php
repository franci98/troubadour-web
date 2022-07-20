<?php

namespace App\Http\Controllers\API\v3\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeworkResource;
use App\Models\Classroom;
use App\Models\Homework;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * @OA\Get(
     *      path="/classrooms/{classroom_id}/homeworks",
     *      tags={"Homeworks"},
     *     security={{"bearerAuth":{}}},
     *      summary="Homework list",
     *      description="Returns a list of classroom's homeworks.",
     *      @OA\Parameter(
     *          name="classroom_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful response.",
     *      ),
     * )
     */
    public function index(Classroom $classroom)
    {
//        $this->authorize('viewAny', [Homework::class, $classroom]);

        return HomeworkResource::collection($classroom->homeworks);
    }

    /**
     * @OA\Get(
     *      path="/classrooms/{classroom_id}/homeworks/{homework_id}",
     *      tags={"Homeworks"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get homework details",
     *      description="Returns homework details.",
     *      @OA\Parameter(
     *          name="classroom_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="homework_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful response.",
     *      ),
     * )
     */
    public function show(Classroom $classroom, Homework $homework)
    {
//        $this->authorize('view', $homework);

        $homework->load('games');

        return HomeworkResource::make($homework);
    }
}
