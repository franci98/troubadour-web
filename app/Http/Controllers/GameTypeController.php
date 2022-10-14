<?php

namespace App\Http\Controllers;

use App\Models\GameType;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;

class GameTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = GameType::withTrashed();

        $dataTable = DataTable::make(__('messages.game_type_index_title'), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('id', '#', true, true, fn($item) => $item->id));
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.game_type_index_column_title'), true, true, fn($item) => $item->title));
        $dataTable->addColumn(DataTableColumn::text('description', __('messages.game_type_index_column_description'), false, false, fn($item) => $item->description));

        $actions = DataTableColumn::actions();
        $actions->addAction(DataTableColumnAction::normal(__('messages.game_type_index_button_edit'), fn($item)=> route('admin.game-types.edit', $item)));
        $dataTable->addColumn($actions);

        return $dataTable->response();
    }

    public function edit(GameType $gameType)
    {

    }
}
