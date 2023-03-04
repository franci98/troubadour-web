<?php

namespace App\Http\Controllers\GameType;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\GameType;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;

class GameTypeController extends Controller
{
    function __construct() {
        $this->addBreadcrumbItem(__('messages.breadcrumbs_super_admin_index'), route('super-admin.index'));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_game_type_index'), route('super-admin.game-types.index'));
    }

    public function index(Request $request)
    {
        $this->shareBreadcrumbs();

        $query = GameType::withTrashed();

        $dataTable = DataTable::make(__('messages.game_type_index_title'), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('id', '#', true, true, fn($item) => $item->id));
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.game_type_index_column_title'), true, true, fn($item) => $item->title));
        $dataTable->addColumn(DataTableColumn::text('description', __('messages.game_type_index_column_description'), false, false, fn($item) => $item->description));

        $actions = DataTableColumn::actions();
        $actions->addAction(DataTableColumnAction::normal(__('messages.game_type_index_button_edit'), fn($item)=> route('super-admin.game-types.edit', $item))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::destructive(__('messages.game_type_index_button_destroy'), fn($item)=> route('super-admin.game-types.destroy', $item))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::confirmable(__('messages.game_type_index_button_restore'), fn($item)=> route('super-admin.game-types.restore', $item))->setCondition(fn($item) => $item->trashed()));
        $actions->addAction(DataTableColumnAction::normal(__('messages.game_type_index_button_difficulties'), fn($item)=> route('super-admin.game-types.difficulties.index', $item))->setCondition(fn($item) => !$item->trashed()));
        $actions->addAction(DataTableColumnAction::normal(__('messages.game_type_index_button_difficulty_categories'), fn($item)=> route('super-admin.game-types.difficulty-categories.index', $item))->setCondition(fn($item) => !$item->trashed()));
        $dataTable->addColumn($actions);

        return $dataTable->response();
    }

    public function edit(GameType $gameType)
    {
        $dataForm = DataForm::make(__('messages.game_type_edit_title', [$gameType->title]), 'PUT', route('super-admin.game-types.update', $gameType), route('super-admin.game-types.index'));

        $dataForm->addInput(DataFormInput::text(__('messages.game_type_title'), 'title', true, 1, 255, $gameType->title));
        $dataForm->addInput(DataFormInput::textarea(__('messages.game_type_description'), 'description', true, 1, 5000, 3, $gameType->description));

        return $dataForm->response();
    }

    public function update(Request $request, GameType $gameType)
    {
        $data = $request->validate([
            'title' => 'string',
            'description' => 'string',
        ]);

        $gameType->update($data);

        return redirect()
            ->route('super-admin.game-types.index')
            ->with('status', __('messages.game_type_update_success'));
    }

    public function destroy(GameType $gameType)
    {
        $gameType->delete();

        return redirect()
            ->route('super-admin.game-types.index')
            ->with('status', __('messages.game_type_destroy_success'));
    }

    public function restore(int $gameTypeId)
    {
        GameType::onlyTrashed()->find($gameTypeId)->restore();

        return redirect()
            ->route('super-admin.game-types.index')
            ->with('status', __('messages.game_type_restore_success'));
    }
}
