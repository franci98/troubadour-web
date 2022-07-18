<?php

namespace App\Http\Controllers\Classroom;

use App\Enum\ChallengeType;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Difficulty;
use App\Models\GameType;
use App\Models\Homework;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function index(Request $request, Classroom $classroom)
    {
//        $this->authorize('viewAny', [Homework::class, $classroom]);

        $query = Homework::query()
            ->where('classroom_id', $classroom->id)
            ->latest();

        $dataTable = DataTable::make(__('messages.homeworks_index_title'), $request, $query);
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.name'), true, true, fn($item) => $item->name));
        $dataTable->addColumn(DataTableColumn::text('available_at', __('messages.available_at'), true, true, fn($item) => $item->available_at->format('j. n. Y G:i')));
        $dataTable->addColumn(DataTableColumn::text('finished_at', __('messages.finished_at'), true, true, fn($item) => $item->finished_at->format('j. n. Y G:i')));

        $dataTableActionsColumn = DataTableColumn::actions();
        $dataTableActionsColumn->addAction(DataTableColumnAction::normal(__('messages.show'), fn($item) => route('classrooms.homeworks.show', [$classroom, $item]) ));
        $dataTable->addColumn($dataTableActionsColumn);

        $dataTable->addButton(route('classrooms.homeworks.create', $classroom), __('messages.homeworks_index_create_button'));

        return $dataTable->response();
    }

    public function create(Classroom $classroom)
    {
//        $this->authorize('create', [Homework::class]);

        $dataForm = DataForm::make(__('messages.homeworks_create_title'), 'POST', route('classrooms.homeworks.store', $classroom), route('classrooms.homeworks.index', $classroom));

        $query = GameType::query()->select('title', 'id AS value')->orderBy('title')->get();
        $dataForm->addInput(DataFormInput::text(__('messages.homeworks_create_name_title'), 'name', true, 3, 255));
        $dataForm->addInput(DataFormInput::select(__('messages.homeworks_create_game_type_id_title'), 'game_type_id', true, $query));
        $dataForm->addInput(DataFormInput::component('homework.difficulty_select', ['difficulties' => Difficulty::query()->orderBy('title')->get()]));
        $dataForm->addInput(DataFormInput::number(__('messages.homeworks_create_games_required_title'), 'games_required', true, 1, 10));
        $dataForm->addInput(DataFormInput::datetime(__('messages.homeworks_create_available_at_title'), 'available_at', true, now()->addMinutes(1)));
        $dataForm->addInput(DataFormInput::datetime(__('messages.homeworks_create_finished_at_title'), 'finished_at', true, now()->addHour()));

        return $dataForm->response();
    }

    public function store(Request $request)
    {
//        $this->authorize('create', [Homework::class]);

        $data = $request->validate([
            'name' => 'required',
            'games_required' => 'required|numeric|min:1',
            'game_type_id' => 'required|exists:game_types,id',
            'difficulty_id' => 'required|exists:difficulties,id',
            'finished_at' => 'required|date',
            'available_at' => 'required|date',
        ]);

        $homework = new Homework($data);
        $homework->classroom()->associate($this->classroom);
        $homework->save();
        foreach ($this->classroom->users as $user) {
            $homework->addUser($user);
        }
        $homework->createGames();

        return redirect()->route('classrooms.homeworks.index', $this->classroom);
    }

    public function show(Homework $homework)
    {
        //
    }

    public function edit(Homework $homework)
    {
        //
    }

    public function update(Request $request, Homework $homework)
    {
        //
    }

    public function destroy(Homework $homework)
    {
        //
    }
}
