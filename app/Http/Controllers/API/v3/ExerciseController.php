<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Utils\Midi\MidiNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ExerciseController extends Controller
{
    /**
     * @param Request $request
     * @param Exercise $exercise
     * @return \Illuminate\Http\Response
     *
     * @OA\Get (
     *     path="/exercises/{id}/sound",
     *     tags={"Exercise"},
     *     security={{"bearerAuth":{}}},
     *     summary="Exercise sound",
     *     description="Get exercise sound.",
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Exercise id"
     *    ),
     *     @OA\Parameter(
     *     name="metronome",
     *     in="query",
     *     required=false,
     *     description="Metronome on/off",
     *     @OA\Schema(
     *     type="boolean",
     *     default="true"
     *    )
     *   ),
     *     @OA\Parameter(
     *     name="bpm",
     *     in="query",
     *     required=false,
     *     description="BPM override",
     *     @OA\Schema(
     *     type="integer",
     *     default="120"
     *   )
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Exercise sound was successfuly generated. The sound is returned. NOTE: The sound is not playable in the Swagger UI.",
     *     @OA\MediaType(
     *     @OA\Schema(
     *     type="string",
     *     format="binary"
     *   )
     * )
     * )
     * )
     *
     */
    public function sound(Request $request, Exercise $exercise)
    {
        $data = $request->validate([
            'metronome' => Rule::in(['true', 'false']),
            'bpm' => 'integer',
        ]);

        $info = (object) [
            'metronome' => true,
        ];

        $rawMetronome = $request->input('metronome');
        if($rawMetronome === 'false') {
            $info->metronome = false;
        }

        $rawBPMOverride = $request->input('bpm');
        $BPMOverride = ctype_digit($rawBPMOverride) ? intval($rawBPMOverride) : false;
        if($BPMOverride) {
            $info->BPMOverride = $BPMOverride;
        }


        $userID = auth()->user()->id;
        $baseFilePath = Storage::path("u" . $userID . "e" . $exercise->id);

        $mn = new MidiNotes();
        $outStatus = $mn->GenerateExerciseSound($exercise->rhythmExercise->id, $baseFilePath, $info);

        // Return file
        $file = Storage::get("u" . $userID . "e" . $exercise->id . ".mp3");
        $response = Response::make($file, 200);
        $response->header("Content-Type", "audio/mp3");
        return $response;
    }

}
