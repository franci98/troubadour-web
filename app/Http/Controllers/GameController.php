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
        if ($game->gameType->id == GameType::INTERVALS) {
            foreach ($game->exercises as $i => $question) {
                $dataView->addItem(DataViewItem::component('exercise.interval', ['exercise' => $question->intervalExercise], 'col-12', __('messages.exercise') . " " . ($i + 1)));
            }
        } else if ($game->gameType->id == GameType::RHYTHM) {
            foreach ($game->exercises as $i => $question) {
                $dataView->addItem(DataViewItem::component('exercise.rhythm', ['rhythmExercise' => $question->rhythmExercise], 'col-12', __('messages.exercise') . " " . ($i + 1)));
            }
        }

        return $dataView->response();
    }
}
