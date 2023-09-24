<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameType;
use App\Utilities\DataView;
use App\Utilities\DataViewItem;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show(Game $game)
    {
        $this->authorize('view', $game);

        $dataView = DataView::make();
        $dataView->setTitle(__('messages.game_show_title', [$game->id]));

        $dataView->addItem(DataViewItem::text(__('messages.game_show_created_at'), $game->created_at->format('d.m.Y H:i'), 'col-12'));


        foreach ($game->exercises as $i => $question) {
            $exercise = [];
            switch($game->gameType->id) {
                case GameType::INTERVALS:
                    $exercise = $question->intervalExercise;
                    break;
                case GameType::HARMONIC:
                    $exercise = $question->harmonyExercise;
                    break;
                case GameType::INVERSE_INTERVALS:
                    $exercise = $question->inverseIntervalExercise;
                    break;
                case GameType::INVERSE_HARMONIC:
                    $exercise = $question->inverseHarmonyExercise;
                    break;
                case GameType::RHYTHM:
                    $exercise = $question->rhythmExercise;
                    break;
            }
            if ($game->gameType->id == GameType::RHYTHM) {
                $dataView->addItem(DataViewItem::component('exercise.rhythm', ['rhythmExercise' => $exercise], 'col-12', __('messages.exercise') . " " . ($i + 1)));
            }
            else if ($game->gameType->id == GameType::HARMONIC || $game->gameType->id == GameType::INVERSE_HARMONIC) {
                $dataView->addItem(DataViewItem::component('exercise.harmony', ['exercise' => $exercise], 'col-12', __('messages.exercise') . " " . ($i + 1)));
            }
            else {
                $dataView->addItem(DataViewItem::component('exercise.interval', ['exercise' => $exercise], 'col-12', __('messages.exercise') . " " . ($i + 1)));
            }  
        }

        return $dataView->response();
    }
}
