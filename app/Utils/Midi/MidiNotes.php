<?php

namespace App\Utils\Midi;

use App\Models\Exercise;
use App\Models\HarmonyExercise;
use App\Models\IntervalExercise;
use App\Models\PrimarySchoolRhythmExercise;
use Illuminate\Support\Facades\Log;
use Motniemtin\Midi\Midi;
use App\Utils\Midi\MidiMsg as MSG;

use App\Models\RhythmExercise;

use Exception;
use Symfony\Component\ErrorHandler\Debug;

class MidiNotes
{

    private static $midiPitchMap = [
        'C3' => 48,
        'Db3' => 49,
        'D3' => 50,
        'Eb3' => 51,
        'E3' => 52,
        'F3' => 53,
        'Gb3' => 54,
        'G3' => 55,
        'Ab3' => 56,
        'A3' => 57,
        'Bb3' => 58,
        'B3' => 59,
        'C4' => 60,
        'Db4' => 61,
        'D4' => 62,
        'Eb4' => 63,
        'E4' => 64,
        'F4' => 65,
        'Gb4' => 66,
        'G4' => 67,
        'Ab4' => 68,
        'A4' => 69,
        'Bb4' => 70,
        'B4' => 71,
        'C5' => 72,
        'Db5' => 73,
        'D5' => 74,
        'Eb5' => 75,
        'E5' => 76,
        'F5' => 77,
        'Gb5' => 78,
        'G5' => 79,
        'Ab5' => 80,
        'A5' => 81,
        'Bb5' => 82,
        'B5' => 83,
        'C6' => 84,
        'Db6' => 85,
        'D6' => 86,
        'Eb6' => 87,
        'E6' => 88,
        'F6' => 89,
        'Gb6' => 90,
        'G6' => 91,
        'Ab6' => 92,
        'A6' => 93,
        'Bb6' => 94,
        'B6' => 95,
        'C7' => 96,
    ];

    private static $lowerToUpperMap = [
        'C#3' => 'Db3',
        'D#3' => 'Eb3',
        'E#3' => 'F3',
        'Fb3' => 'E3',
        'F#3' => 'Gb3',
        'G#3' => 'Ab3',
        'A#3' => 'Bb3',
        'B#3' => 'C4',
        'Cb4' => 'B3',
        'C#4' => 'Db4',
        'D#4' => 'Eb4',
        'E#4' => 'F4',
        'Fb4' => 'E4',
        'F#4' => 'Gb4',
        'G#4' => 'Ab4',
        'A#4' => 'Bb4',
        'B#4' => 'C5',
        'Cb5' => 'B4',
        'C#5' => 'Db5',
        'D#5' => 'Eb5',
        'E#5' => 'F5',
        'Fb5' => 'E5',
        'F#5' => 'Gb5',
        'G#5' => 'Ab5',
        'A#5' => 'Bb5',
        'B#5' => 'C6',
        'Cb6' => 'B5',
        'C#6' => 'Db6',
        'D#6' => 'Eb6',
        'E#6' => 'F6',
        'Fb6' => 'E6',
        'F#6' => 'Gb6',
        'G#6' => 'Ab6',
        'A#6' => 'Bb6',
        'B#6' => 'C7',
        'Cb7' => 'B6',
    ];

    public $noteForce = 60;

    public function generateExerciseSound($exId, $baseFilePath, $info)
    {

        $data = RhythmExercise::query()->find($exId);

        if (!$data) {
            return null;
        }
        $data = (object) $data;


        $enableMetronome = $info->metronome;
        $BPM = isset($info->BPMOverride) ? $info->BPMOverride : $data->BPM;

        $file = $this->NotesToSound(
            $data->exercise,
            $baseFilePath,
            $data->notesCollection(),
            (object) [
                "enableMetronome" => $enableMetronome,
                "BPM" => $BPM,
                "bar" => (object) $data->barInfo->bar_info,
                "pitch" => (object) [
                    "exercise" => [69],
                    "metronome" => [60, 70]
                ]
            ],
        );

        RhythmExercise::query()->where('id', $exId)->update(['mp3_generated' => 1]);

        return (object) ['ok' => true, 'file' => $file];
    }

    public function generatePrimarySchoolRhythmExerciseSound($exId, $baseFilePath, $info)
    {

        $data = PrimarySchoolRhythmExercise::query()->find($exId);

        if (!$data) {
            return null;
        }
        $data = (object) $data;


        $enableMetronome = $info->metronome;
        $BPM = isset($info->BPMOverride) ? $info->BPMOverride : $data->BPM;

        $file = $this->NotesToSound(
            $data->exercise,
            $baseFilePath,
            $data->notesCollection(),
            (object) [
                "enableMetronome" => $enableMetronome,
                "BPM" => $BPM,
                "bar" => (object) $data->primarySchoolBarInfo->bar_info,
                "pitch" => (object) [
                    "exercise" => [69],
                    "metronome" => [60, 70]
                ]
            ],
        );

        PrimarySchoolRhythmExercise::query()->where('id', $exId)->update(['mp3_generated' => 1]);

        return (object) ['ok' => true, 'file' => $file];
    }

    public function generateIntervalExerciseSound($exId, $baseFilePath, $info)
    {

        $data = IntervalExercise::query()->find($exId);

        if (!$data) {
            return null;
        }
        $data = (object) $data;

        $enableMetronome = $info->metronome;
        $BPM = 60;


        $file = $this->NotesToSound(
            $data->exercise,
            $baseFilePath,
            $data->notesCollection(),
            (object) [
                "enableMetronome" => $enableMetronome,
                "BPM" => $BPM,
                "bar" => (object) ['base_note' => 4, 'num_beats' => 3],
                "pitch" => (object) [
                    "exercise" => collect($data->value)->map(fn ($item) => MidiNotes::$midiPitchMap[$item] ?? MidiNotes::$midiPitchMap[MidiNotes::$lowerToUpperMap[$item]])->toArray()
                ]
            ],
        );

        //        RhythmExercise::query()->where('id', $exId)->update(['mp3_generated' => 1]);

        return (object) ['ok' => true, 'file' => $file];
    }

    private static function getMidi($key)
    {


        if (array_key_exists($key, MidiNotes::$midiPitchMap)) {
            return MidiNotes::$midiPitchMap[$key];
        } else {
            return MidiNotes::$midiPitchMap[MidiNotes::$lowerToUpperMap[$key]];
        }
    }

    private static function removeDoubleAccidentals($key)
    {
        $increase = 0;
        if (str_contains($key, '##')) {
            $key = str_replace('##', '', $key);

            if ($key[0] == 'B') {
                $increase = 1;
            };


            if ($key[0] == 'G') $key = 'A' . substr($key, 1);
            else $key = (chr(ord($key[0]) + 1)) . substr($key, 1);
        } else if (str_contains(substr($key, 1), 'bb')) {
            $key = $key[0] . str_replace('bb', '', substr($key, 1));
            if ($key[0] == 'C') {
                $increase = -1;
            };


            if ($key[0] == 'A') $key = 'G' . substr($key, 1);
            else $key = chr(ord($key[0]) - 1) . substr($key, 1);
        }

        return substr($key, 0, strlen($key) - 1) . ((substr($key, strlen($key) - 1) + $increase));
    }

    public function generateHarmonyExerciseSound($exId, $baseFilePath, $info)
    {

        $data = HarmonyExercise::query()->find($exId);

        if (!$data) {
            return null;
        }
        $data = (object) $data;


        $enableMetronome = $info->metronome;
        $BPM = 60;


        $midiKeys = [];
        foreach ($data->value['keys'] as $key) {
            $t = str_replace('/', '', $key);
            $t = self::removeDoubleAccidentals($t);
            $midiKey = self::getMidi($t);
            $midiKeys[] = $midiKey;
        }

        if (!$data->value['razlozen']) {
            $midiKeys = array_map(fn($value) => [$value],  $midiKeys);
        }

        $file = $this->NotesToSound(
            $data->exercise,
            $baseFilePath,
            $data->notesCollection(),
            (object) [
                "enableMetronome" => $enableMetronome,
                "BPM" => $BPM,
                "bar" => (object) ['base_note' => 4, 'num_beats' => 3],
                "pitch" => (object) [
                    "exercise" => $midiKeys
                ]
            ],
            !$data->value['razlozen']
        );

        return (object) ['ok' => true, 'file' => $file];
    }


    public function SetupMidi($BPM, $trackCount = 2)
    {

        $midi = new Midi();
        $midi->open();

        $tempo = 480000 * 60 / $BPM;

        $midi->setTempo($tempo);

        for ($i = 0; $i < $trackCount; $i++) {
            $midi->newTrack();
        }

        return $midi;
    }

    public function Instrument($midi, $trId, int $instrumentMidiTone = 4)
    {

        $i = $instrumentMidiTone;

        $midi->addMsg($trId, MSG::Param(0, $trId, 0, 121));
        $midi->addMsg($trId, MSG::Param(0, $trId, 32, 0));
        $midi->addMsg($trId, MSG::ProgramChange(0, $trId, $i));
    }

    /*
    info {
        BPM: 60,
        bar: [
            base_note: 4,
            num_beats: 4
        ],
        pitch: [
            exercise: [],
            metronome: []
        ],
    }
    */

    /*
    trackInfo {
        currentTime: 0
        trackId: 1,
        pitch: [],
        constDuration: null,
    }
    */


    public function GetMetronomePitches($bar, $num_bars = 1)
    {

        // Original
        // [93, 86];

        $hi = 100;
        $lo = 76;

        $pitches = [];

        for ($ooo = 0; $ooo < $num_bars; $ooo++) {
            if (isset($bar->subdivisions)) {

                foreach ($bar->subdivisions as $s) {
                    $pitches[] = $hi;
                    for ($i = 1; $i < $s->n; $i++) {
                        $pitches[] = $lo;
                    }
                }
            } else if (!isset($bar->subdivisions) && $bar->base_note == 8 && $bar->num_beats == 6) {

                // Special counting for 6/8 time...
                $pitches = array_merge($pitches, [$hi, $lo, $lo, $hi, $lo, $lo]);
            } else if (!isset($bar->subdivisions) && $bar->base_note == 8 && $bar->num_beats == 9) {

                // Special counting for 6/8 time...
                $pitches = array_merge($pitches, [$hi, $lo, $lo, $hi, $lo, $lo, $hi, $lo, $lo]);
            } else {
                $pitches[] = ($hi);
                for ($i = 1; $i < $bar->num_beats; $i++) {
                    $pitches[] = $lo;
                }
            }
        }

        return $pitches;
    }

    public function GetMetronomeNotes($bar, $num_bars = 1)
    {

        $countInNotes = [];

        for ($vv = 0; $vv < $num_bars; $vv++) {
            if (isset($bar->subdivisions)) {
                foreach ($bar->subdivisions as $sd) {
                    for ($i = 0; $i < $sd->n; $i++) {
                        $countInNotes[] = (object) ["type" => 'n', "value" => $sd->d];
                    }
                }
            } else {
                for ($i = 0; $i < $bar->num_beats; $i++) {
                    $countInNotes[] = (object)["type" => 'n', "value" => $bar->base_note];
                }
            }
        }

        return $countInNotes;
    }

    public function GetMIDIData($midi, $notes, $info, $trackInfo)
    {

        $durs = MusiSONUtils::toDurations($notes);

        $currentTime = $trackInfo->currentTime;

        $currentNoteID = 0;
        foreach ($durs as $dur) {

            $realDuration = $dur->toFloat() * $info->bar->base_note;

            if ($realDuration > 0) {
                $pitchL = count($trackInfo->pitch) - 1;
                $sPitch = $trackInfo->pitch[min($pitchL, $currentNoteID)];

                $engineDuration = ($realDuration - 0.05);

                if ($trackInfo->constDuration != null) {
                    $engineDuration = $trackInfo->constDuration;
                }

                $midi->addMsg($trackInfo->trackId, MSG::On(
                    $currentTime,  // Timestamp
                    $trackInfo->trackId,  // Channel
                    $sPitch, // Note
                    $trackInfo->noteForce  // Kok useka
                ));

                $midi->addMsg($trackInfo->trackId, MSG::Off(
                    ($engineDuration + $currentTime),
                    $trackInfo->trackId,  // Channel
                    $sPitch, // Note
                    0  // Kok useka
                ));
            } else {
                // Rest or unknown
                $realDuration = -$realDuration;
            }

            $currentTime += $realDuration;

            $currentNoteID++;
        }

        return $currentTime;
    }

    public function NotesToSound(Exercise $exercise, $baseFilePath, $notes, $info, $isChord = false)
    {
        $timeDiff = 0;
        $midi = $this->SetupMidi($info->BPM, $info->enableMetronome ? 2 : count($info->pitch->exercise));

        if ($info->enableMetronome) {
            $countinNotes = $this->GetMetronomeNotes($info->bar, 1);
            $countinPitch = $this->GetMetronomePitches($info->bar, 1);

            $metronomeNotes = $this->GetMetronomeNotes($info->bar, 2);
            $metronomePitch = $this->GetMetronomePitches($info->bar, 2);

            // Countdown
            $this->Instrument($midi, 2, 13);
            $timeDiff = $this->GetMIDIData($midi, $countinNotes, $info, (object)[
                "trackId" => 2,
                "pitch" => $countinPitch,
                "currentTime" => 0,
                "constDuration" => 0.2,
                "noteForce" => 80,
            ]);
        }

        // Melody
        $this->Instrument($midi, 1, $exercise->getMidiInstrumentCode());
        if ($isChord) {
            foreach ($info->pitch->exercise as $i => $item) {
                $this->GetMIDIData($midi, $notes, $info, (object) [
                    "trackId" => $i + 1,
                    "pitch" => $item,
                    "currentTime" => $timeDiff,
                    "constDuration" => null,
                    "noteForce" => 50,
                ]);
            }
        } else {
            $this->GetMIDIData($midi, $notes, $info, (object) [
                "trackId" => 1,
                "pitch" => $info->pitch->exercise,
                "currentTime" => $timeDiff,
                "constDuration" => null,
                "noteForce" => 50,
            ]);
        }

        // Metronome
        if ($info->enableMetronome) {
            $this->Instrument($midi, 2, 13);
            $this->GetMIDIData($midi, $metronomeNotes, $info, (object) [
                "trackId" => 2,
                "pitch" => $metronomePitch,
                "currentTime" => $timeDiff,
                "constDuration" => 0.2,
                "noteForce" => 90,
            ]);
        }

        $midiFileName = "$baseFilePath.mid";
        $wavFileName  = "$baseFilePath.wav";
        $mp3FileName  = "$baseFilePath.mp3";


        $c = new MidiConvert();
        $midi->saveMidFile($midiFileName);
        $wav = $c->toWav($midiFileName, $wavFileName);
        $mp3 = $c->toMP3($wavFileName, $mp3FileName);

        return $mp3FileName;
    }
}
