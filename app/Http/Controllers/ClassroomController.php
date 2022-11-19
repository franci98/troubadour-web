<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Game;
use App\Models\GameUser;
use App\Models\Homework;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->addBreadcrumbItem(__('messages.breadcrumbs_classroom_index'), route('classrooms.index'));
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Classroom::class);
        $this->shareBreadcrumbs();

        $query = Classroom::query();
        if (auth()->user()->isSuperAdmin()) {
            $query->orderBy('name');
        } else if (auth()->user()->isSchoolAdmin()) {
            $query->whereHas('school', function ($query) {
                $query->where('id', auth()->user()->school->id);
            });
        } else if (auth()->user()->isTeacher()) {
            $query->where('user_id', auth()->user()->id);
        } else {
            abort(403);
        }

        $dataTable = DataTable::make(__('messages.classroom_index_title'), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('name', __('messages.classroom_index_column_name'), true, true, fn($item) => $item->name));
        $dataTable->addColumn(DataTableColumn::text('user.name', __('messages.classroom_index_column_teacher'), false, true, fn($item) => $item->user->name, fn($item) => $item->school->name));
        $dataTable->addColumn(DataTableColumn::text('created_at', __('messages.classroom_index_column_created_at'), false, true, fn($item) => $item->created_at->format('d.m.Y H:i:s')));

        $actionsColumn = DataTableColumn::actions();
        $actionsColumn->addAction(DataTableColumnAction::normal(__('messages.classroom_index_column_action_show'), fn($item) => route('classrooms.show', $item)));
        $actionsColumn->addAction(DataTableColumnAction::normal(__('messages.classroom_index_column_action_edit'), fn($item) => route('classrooms.edit', $item)));
        $actionsColumn->addAction(DataTableColumnAction::destructive(__('messages.classroom_index_column_action_delete'), fn($item) => route('classrooms.destroy', $item)));
        $dataTable->addColumn($actionsColumn);

        $dataTable->addButton(route('classrooms.create'), __('messages.classroom_index_button_create'));

        return $dataTable->response();
    }

    public function show(Classroom $classroom)
    {
        $this->authorize('view', $classroom);
        $this->addBreadcrumbItem($classroom->name, route('classrooms.show', $classroom), true);

        $homeworks = Homework::query()
            ->where('classroom_id', $classroom->id)
            ->whereDate('available_at', '>', now()->subWeek())
            ->get();

        $gameUsers = GameUser::query()
            ->whereIn('game_id', Game::query()->whereIn('homework_id', $homeworks->pluck('id'))->pluck('id'))
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', compact('classroom', 'homeworks', 'gameUsers'));
    }

    public function create()
    {
        $this->authorize('create', Classroom::class);
        $this->addBreadcrumbItem(__('messages.breadcrumbs_classroom_create'), route('classrooms.create'), true);
        $this->shareBreadcrumbs();

        $postRoute = route('classrooms.store');
        $cancelRoute = route('classrooms.index');
        $dataForm = DataForm::make(__('messages.classroom_create_title'), 'POST', $postRoute, $cancelRoute);

        // Add data form inputs
        $dataForm->addInput(DataFormInput::text(__('messages.classroom_create_input_name'), 'name', true, 1, 1024));

        return $dataForm->response();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $classroom = new Classroom($data);
        $classroom->user()->associate(Auth::user());
        $classroom->school()->associate(Auth::user()->school_id);
        $classroom->save();

        return redirect()->route('classrooms.show', $classroom);
    }

    public function edit(Classroom $classroom)
    {
        $this->authorize('update', $classroom);
        $this->addBreadcrumbItem($classroom->name, route('classrooms.show', $classroom));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_classroom_edit'), route('classrooms.edit', $classroom), true);
        $this->shareBreadcrumbs();

        $postRoute = route('classrooms.update', $classroom);
        $cancelRoute = route('classrooms.index');
        $dataForm = DataForm::make(__('messages.classroom_edit_title'), 'PUT', $postRoute, $cancelRoute);

        // Add data form inputs
        $dataForm->addInput(DataFormInput::text(__('messages.classroom_edit_input_name'), 'name', true, 1, 1024, $classroom->name));

        return $dataForm->response();
    }

    public function update(Request $request, Classroom $classroom)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $classroom->update($data);

        return redirect()->route('classrooms.show', $classroom);
    }

    public function destroy(Classroom $classroom)
    {
        $this->authorize('delete', $classroom);
        $classroom->delete();
        return redirect()->route('classrooms.index');
    }
}
