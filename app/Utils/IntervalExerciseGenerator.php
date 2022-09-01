<?php

namespace App\Utils;

use App\Models\IntervalExercise;

class IntervalExerciseGenerator extends ExerciseGenerator
{
    public function generateExercise(): IntervalExercise
    {
        // Could be modified from difficulty
        $difficultyRange = $this->exercise->game->difficulty->parameters['range'] ?? 5;
        // Could be modified from difficulty
        $nNotes = rand($this->exercise->game->difficulty->parameters['min_notes'] ?? 4, $this->difficulty->parameters['max_notes'] ?? 8);

        $pitches = ['A#3', 'B3', 'C4', 'C#4', 'D4', 'D#4', 'E4', 'F4', 'F#4', 'G4', 'G#4', 'A4', 'A#4', 'B4', 'C5', 'C#5'];

        $sample = [];
        $pitchOccurrences = [];

        foreach ($pitches as $pitch) {
            $pitchOccurrences[$pitch] = 0;
        }

        $pitchIndex = 0;
        $topRange = 0;
        $bottomRange = 0;
        $rangeSum = 0;
        $direction = '';
        $range = 0;
        $nSemitones = 0;
        $intervalIndex = 0;

        // randomly generate first note and add it to the sample
        $pitch = $pitches[array_rand($pitches)];
        $sample[] = $pitch;

        // generate consecutive notes based on the previous note
        for ($i = 1; $i < $nNotes; $i++) {
            $pitchIndex = array_search($pitch, $pitches);

            // define possible range (steps allowed to the top / bottom)
            $topRange = count($pitches) - $pitchIndex - 1;
            $bottomRange = $pitchIndex;
            $rangeSum = $topRange + $bottomRange;

            // choose direction of the interval by using weighted random
            $direction = Utils::weightedRandom(['down' => $bottomRange / $rangeSum, 'up' => $topRange / $rangeSum]);

            // potentially limit the range of the interval with the difficulties' predefined range
            $range = $direction == 'down' ? min($difficultyRange, $bottomRange) : min($difficultyRange, $topRange);

            // randomly choose the actual range
            $nSemitones = rand(0, $range);
            $intervalIndex = $direction == 'down' ? ($pitchIndex - $nSemitones) : ($pitchIndex + $nSemitones);

            // based on the range find the pitch
            $pitch = $pitches[$intervalIndex];

            // check if the pitch satisfies the defined constraints
            if ($pitchOccurrences[$pitch] === 2 || (($i === 1 || $i === $nNotes - 1) && $sample[$i - 1] === $pitch)) {
                $i--;
                continue;
            }

            // add the pitch to the sample
            $sample[] = $pitch;

            // keep track of how many times each of the pitches already occurred in the sample
            $pitchOccurrences[$pitch]++;
        }
        $intervalExercise = IntervalExercise::query()->create([
            'exercise_id' => $this->exercise->id,
            'value' => $sample,
        ]);

        return $intervalExercise;
    }
}
