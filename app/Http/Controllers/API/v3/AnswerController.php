<?php

namespace App\Http\Controllers\API\v3;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * @OA\Post(
     *      path="/answers",
     *      tags={"Game"},
     *      security={{"bearerAuth":{}}},
     *      summary="Save answer",
     *      description="Saves a new answer for the given exercise.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/AnswerCreateRequest")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Answer was saved successfully"
     *       )
     * )
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'exercise_id' => 'required|exists:exercises,id',
            'solving_time' => 'nullable|integer|min:0',
            'number_of_attempts' => 'required|integer|min:0',
        ]);

        $answer = new Answer($data);
        $answer->user()->associate(Auth::id());
        $answer->save();

        return response()->json(null, Response::HTTP_CREATED);
    }
}
