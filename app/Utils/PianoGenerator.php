<?php

// USE WITH CAUTION, THIS WILL GENERATE WRONG INTERVAL EXERCISES

// Utility that will generate mp3 files for each note defined in MidiNotes::$midiPitchMap
namespace App\Utils;

use App\Utils\Midi\MidiNotes;

use App\Models\IntervalExercise;


class PianoGenerator {

    static public function generatePiano()
    {
        foreach(MidiNotes::$midiPitchMap as $note => $midi) {
            $intervalExercise = IntervalExercise::query()->create([
                'exercise_id' => $midi,
                'value' => [$note],
            ]);
            $info = (object) [
                'metronome' => false,
            ];
            $soundController = new MidiNotes();
            $soundController->generateIntervalExerciseSound($intervalExercise->id, public_path('audio/').$intervalExercise->value[0], $info);
        }
    }


}