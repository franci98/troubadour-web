<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->addBreadcrumbItem(__('messages.breadcrumbs_user_index'), route('users.index'));
    }

    public function addBaseBreadcrumbs(User $user)
    {
        $this->addBreadcrumbItem($user->name, route('users.show', $user->id));
    }

    public function index(User $user, Request $request)
    {
        $this->authorize('viewAny', User::class);
        $this->addBaseBreadcrumbs($user);
        $this->shareBreadcrumbs();

        $query = Game::query()
            ->orderBy('created_at', 'desc')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

        $dataTable = DataTable::make(__('messages.games'), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('id', '#', true, true, fn(Game $game) => $game->id));
        $dataTable->addColumn(DataTableColumn::text('created_at', __('messages.game_index_column_created_at'), true, false, fn(Game $game) => $game->created_at->format('d.m.Y H:i')));
        $dataTable->addColumn(DataTableColumn::text('difficulty.title', __('messages.game_index_column_difficulty'), false, true, fn(Game $game) => $game->difficulty->title ?? ''));
        $dataTable->addColumn(DataTableColumn::text('gameType.title', __('messages.game_index_column_game_type'), false, true, fn(Game $game) => $game->gameType->title));

        $actions = DataTableColumn::actions();
        $actions->addAction(DataTableColumnAction::normal(__('messages.game_index_action_show'), fn(Game $game) => route('games.show', $game->id)));
        $dataTable->addColumn($actions);

        return $dataTable->response();
    }
}
