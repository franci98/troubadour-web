<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RhythmExercise extends Model
{
    use HasFactory;

    public static function generate(Exercise $exercise): RhythmExercise
    {
        $numbars = 2;
        $numSubdivisions = 1;
        /*
         * - Poglej ker rhythm_level je user
         * - Izberi naključni bar_info, ki je primeren za ta level
         * - Inicializiraj arraye za bare in inicializiraj maksimalne dolžine
         * - Prenesi vse pojavitve značilnosti (skupaj z značilnostmi in minimalnimi dolžinami taktov), ki so primerne za ta level in BarInfo
         * - Pojdi čez značilnosti
         *     ○ V boben po vrsti dodaj bare tistih značilnosti, ki imajo nastavljen min_occurrence; Za vsakega naključno določi, v kater bar (1.,2.) gre.
         *         § ChooseCategoryBar($catId, $spaceLeft)
         *         § Če zmanjka prostora, odnehaj in nadaljuj algoritem.
         *     ○ V vrsto za generiranje dodaj vse verjetnosti (kumulativna vsota) (normaliziraj jih s številom verjetnosti), ki imajo minimalno dolžino manjšo ali enako kot $spaceLeft in max_occurrences večji kot število pojavitev te kategorije, da nastane kot nek številski trak
         *     ○ Naključno generiraj številko in jo lociraj na traku - tja kamor pade, tisto kategorijo generiraj:
         *         § Naredi nekaj podobnega za rhythm_bar_occurrence
         *         § Zmanjšaj potrebno dolžino; Če je takt poln, povečaj index generiranega takta
         *         § Povečaj število pojavitev kategorije
         *     ○ Če je index enak številu taktov, odnehaj in shrani vajo.
         *
         */

        // - Poglej ker rhythm_level je user ✅ ($level)
        // - Izberi naključni bar_info, ki je primeren za ta level
    }

    private function getTimeSignature(Difficulty $difficulty): TimeSignature {
        // BarInfo::where('min_rhythm_level', '<=', $level)->get()->all();
        $infos = DB::select("SELECT bi.*, bi.probability as prob
            from bar_infos bi where bi.min_rhythm_level <= ? and bi.id in (
            SELECT b.id
            from bar_infos b
                join rhythm_feature_occurrences fo on fo.bar_info_id = b.id
            where fo.rhythm_level >= ?
            group by b.id
            having COUNT(*) > 0
        )", [$level, $level]);

        // Select time signature which is suitable for this difficulty and has defined features
        $timeSignatures = TimeSignature::query()
            ->whereIn('difficulty_id', $difficulty->getEasierDifficulties(true)->pluck('id'))
            ->whereHas('rhythmFeatureOccurrences', function ($q) use ($difficulty) {
                $q->whereIn('difficulty_in', $difficulty->getHarderDifficulties(true)->pluck('id'));
            });

        if(!$infos || count($infos) == 0) {
            throw new \Exception("There are no time signatures available.");
        }

        return self::weightedRandomSelector($infos, function($b) { return $b->prob; });
    }
}
