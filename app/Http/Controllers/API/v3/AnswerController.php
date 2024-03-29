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
            'deletions' => 'required|integer|min:0',
            'level' => 'required|integer|min:0',
            'sound_replays' => 'required|integer|min:0',
            'score' => 'required|numeric|min:0',
        ]);

        $answer = new Answer($data);
        $answer->user()->associate(Auth::id());
        $answer->save();

        if ($answer->isLastAnswer()) {
            $answer->exercise->game->finishGameFor(Auth::user());
        }

        return response()->json([
            'is_finished' => $answer->isLastAnswer(),
            'current_points' => $answer->exercise->game->answers()->where('user_id', Auth::id())->sum('score'),
        ], Response::HTTP_CREATED);
    }
}
