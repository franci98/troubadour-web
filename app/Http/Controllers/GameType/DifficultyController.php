<?php

namespace App\Http\Controllers\GameType;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Difficulty;
use App\Models\Game;
use App\Models\GameType;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{
    private function addBaseBreadcrumbs(GameType $gameType) {
        $this->addBreadcrumbItem(__('messages.breadcrumbs_game_type_index'), route('super-admin.game-types.index'));
        $this->addBreadcrumbItem($gameType->title, route('super-admin.game-types.index', $gameType));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_difficulty_index'), route('super-admin.game-types.difficulties.index', $gameType));
    }


    public function index(Request $request, GameType $gameType)
    {
        $query = Difficulty::withTrashed()->where('game_type_id', $gameType->id);
        $this->addBaseBreadcrumbs($gameType);
        $this->shareBreadcrumbs();

        $dataTable = DataTable::make(__('messages.difficulty_index_title', [$gameType->title]), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('id', '#', true, true, fn($item) => $item->id));
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.difficulty_index_column_title'), true, true, fn($item) => $item->title, fn($item) => $item->description));

        $actions = DataTableColumn::actions();
        $actions->addAction(DataTableColumnAction::normal(__('messages.difficulty_index_button_edit'), fn($item)=> route('super-admin.game-types.difficulties.edit', [$item->gameType, $item]))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::destructive(__('messages.difficulty_index_button_destroy'), fn($item)=> route('super-admin.game-types.difficulties.destroy', [$item->gameType, $item]))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::confirmable(__('messages.difficulty_index_button_restore'), fn($item)=> route('super-admin.game-types.difficulties.restore', [$item->gameType, $item]))->setCondition(fn($item) => $item->trashed()));
        $dataTable->addColumn($actions);

        return $dataTable->response();
    }

    public function show(GameType $gameType, Difficulty $difficulty)
    {

    }

    public function edit(GameType $gameType, Difficulty $difficulty)
    {
        $this->addBaseBreadcrumbs($gameType);

        $this->addBreadcrumbItem($difficulty->title, route('super-admin.game-types.difficulties.index', [$gameType, $difficulty]));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_difficulty_edit'), route('super-admin.game-types.difficulties.edit', [$gameType, $difficulty]), true);

        $postRoute = route('super-admin.game-types.difficulties.update', [$gameType, $difficulty]);
        $cancelRoute = route('super-admin.game-types.difficulties.index', $gameType);
        $postMethod = 'PUT';
        $dataForm = DataForm::make(__('messages.difficulty_edit_title', [$difficulty->title]), $postMethod, $postRoute, $cancelRoute);

        $dataForm->addInput(DataFormInput::text(__('messages.difficulty_edit_input_title'), 'title', true, 0, 1024, $difficulty->title));
        $dataForm->addInput(DataFormInput::textarea(__('messages.difficulty_edit_input_description'), 'description', true, 0, 1024, 3,$difficulty->description));
        $dataForm->addInput(DataFormInput::textarea(__('messages.difficulty_edit_input_parameters'), 'parameters', true, 0, 1024, 3, json_encode($difficulty->parameters)));

        return $dataForm->response();
    }

    public function update(GameType $gameType, Request $request, Difficulty $difficulty)
    {
        $data = $request->validate([
            'title' => 'required|string|max:1024',
            'description' => 'required|string|max:1024',
            'parameters' => 'required|string|max:1024',
        ]);

        $difficulty->title = $data['title'];
        $difficulty->description = $data['description'];
        $difficulty->parameters = json_decode($data['parameters'], true);
        $difficulty->save();

        return redirect()
            ->route('super-admin.game-types.difficulties.index', $gameType);
    }

    public function destroy(GameType $gameType, Difficulty $difficulty)
    {
        $difficulty->delete();

        return redirect()
            ->route('super-admin.game-types.difficulties.index', $gameType)
            ->with('status', __('messages.difficulty_destroy_success'));
    }

    public function restore(GameType $gameType, int $difficultyId)
    {

        Difficulty::onlyTrashed()->find($difficultyId)->restore();

        return redirect()
            ->route('super-admin.game-types.difficulties.index', $gameType)
            ->with('status', __('messages.difficulty_restore_success'));
    }
}
