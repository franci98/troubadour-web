<?php

namespace App\Http\Controllers\GameType;

use App\Http\Controllers\Controller;
use App\Models\Difficulty;
use App\Models\Game;
use App\Models\GameType;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{
    public function index(Request $request, GameType $gameType)
    {
        $query = Difficulty::withTrashed()->where('game_type_id', $gameType->id);

        $dataTable = DataTable::make(__('messages.difficulty_index_title', [$gameType->title]), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('id', '#', true, true, fn($item) => $item->id));
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.difficulty_index_column_title'), true, true, fn($item) => $item->title, fn($item) => $item->description));

        $actions = DataTableColumn::actions();
        $actions->addAction(DataTableColumnAction::normal(__('messages.difficulty_index_button_show'), fn($item)=> route('admin.game-types.difficulties.show', [$item->gameType, $item]))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::destructive(__('messages.difficulty_index_button_destroy'), fn($item)=> route('admin.game-types.difficulties.destroy', [$item->gameType, $item]))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::confirmable(__('messages.difficulty_index_button_restore'), fn($item)=> route('admin.game-types.difficulties.restore', [$item->gameType, $item]))->setCondition(fn($item) => $item->trashed()));
        $dataTable->addColumn($actions);

        return $dataTable->response();
    }

    public function show(GameType $gameType, Difficulty $difficulty)
    {

    }

    public function edit(GameType $gameType, Difficulty $difficulty)
    {
        //
    }

    public function update(GameType $gameType, Request $request, Difficulty $difficulty)
    {
        //
    }

    public function destroy(GameType $gameType, Difficulty $difficulty)
    {
        $difficulty->delete();

        return redirect()
            ->route('admin.game-types.difficulties.index', $gameType)
            ->with('status', __('messages.difficulty_destroy_success'));
    }

    public function restore(GameType $gameType, int $difficultyId)
    {

        Difficulty::onlyTrashed()->find($difficultyId)->restore();

        return redirect()
            ->route('admin.game-types.difficulties.index', $gameType)
            ->with('status', __('messages.difficulty_restore_success'));
    }
}
