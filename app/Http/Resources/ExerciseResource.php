<?php

namespace App\Http\Resources;

use App\Models\Game;
use App\Models\GameType;
use App\Models\TimeSignature;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'mp3_url' => config('app.url') . "/audio/$this->id.mp3",//"https://trubadur.koin.lgm.fri.ingress.si/audio/$this->id.mp3",
        ];

        if ($this->game->gameType->id == GameType::INTERVALS) {
            $resource['value'] = $this->intervalExercise->value;
        }
        elseif ($this->game->gameType->id == GameType::INVERSE_INTERVALS) {
            $resource['value'] = $this->inverseIntervalExercise->value;
        }
        elseif ($this->game->gameType->id == GameType::RHYTHM || $this->game->gameType->id == GameType::INVERSE_RHYTHM) {
            $resource['value'] = $this->rhythmExercise->bars->pluck('content')
                ->map(function ($content) {
                    return json_decode($content);
                })
                ->flatMap(function ($bar) {
                    if (count($bar) == 1)
                        return [$bar];
                    else {
                        $result = [];
                        foreach ($bar as $item) {
                            $result[] = [$item];
                        }
                        return $result;
                    }
                })
                ->toArray();
            $resource['time_signature'] = $this->rhythmExercise->barInfo;
            $resource['metronome_file_name'] = config('app.url') . "/audio/metronome/$this->id.mp3";
            $resource['beats_per_minute'] = $this->rhythmExercise->BPM;
        } elseif ($this->game->gameType->id == GameType::RHYTHM_GUESS) {
            $resource['value'] = $this->rhythmQuizExercise->bars->pluck('content')
                ->map(function ($content) {
                    return json_decode($content);
                })
                ->flatMap(function ($bar) {
                    if (count($bar) == 1)
                        return [$bar];
                    else {
                        $result = [];
                        foreach ($bar as $item) {
                            $result[] = [$item];
                        }
                        return $result;
                    }
                })
                ->toArray();
            $resource['time_signature'] = $this->rhythmQuizExercise->barInfo;
        } elseif ($this->game->gameType->id == GameType::RHYTHM_TAP) {
            $resource['value'] = RhythmBarResource::collection($this->rhythmExercise->bars);
            $resource['time_signature'] = $this->rhythmExercise->barInfo;
        } elseif ($this->game->gameType->id == GameType::HARMONIC) {
            $resource['value'] = $this->harmonyExercise->value;
        } elseif ($this->game->gameType->id == GameType::PRIMARY_SCHOOL_RHYTHM) {
            $resource['value'] = PrimarySchoolRhythmBarResource::collection($this->primarySchoolRhythmExercise->bars);
            $resource['time_signature'] = $this->primarySchoolRhythmExercise->primarySchoolBarInfo;
        } elseif ($this->game->gameType->id == GameType::INVERSE_HARMONIC) {
            $resource['value'] = $this->inverseHarmonyExercise->value;
        }

        return $resource;
    }
}
