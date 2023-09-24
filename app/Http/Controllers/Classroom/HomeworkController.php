<?php

namespace App\Http\Controllers\Classroom;

use App\Enum\ChallengeType;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Difficulty;
use App\Models\Exercise;
use App\Models\GameType;
use App\Models\Homework;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use App\Utilities\DataView;
use App\Utilities\DataViewItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{

    private function addBaseBreadcrumbs(Classroom $classroom)
    {
        $this->addBreadcrumbItem($classroom->name, route('classrooms.show', $classroom));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_homework_index'), route('classrooms.homeworks.index', $classroom));
    }

    public function index(Request $request, Classroom $classroom)
    {
        //        $this->authorize('viewAny', [Homework::class, $classroom]);
        $this->addBaseBreadcrumbs($classroom);
        $this->shareBreadcrumbs();

        $query = Homework::query()
            ->where('classroom_id', $classroom->id)
            ->latest();

        $dataTable = DataTable::make(__('messages.homework_index_title'), $request, $query);
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.homework_index_column_name'), true, true, fn($item) => $item->name));
        $dataTable->addColumn(DataTableColumn::text('available_at', __('messages.homework_index_column_available_at'), true, true, fn($item) => $item->available_at->format('j. n. Y G:i')));
        $dataTable->addColumn(DataTableColumn::text('finished_at', __('messages.homework_index_column_finished_at'), true, true, fn($item) => $item->finished_at->format('j. n. Y G:i')));

        $dataTableActionsColumn = DataTableColumn::actions();
        $dataTableActionsColumn->addAction(DataTableColumnAction::normal(__('messages.show'), fn($item) => route('classrooms.homeworks.show', [$classroom, $item])));
        $dataTable->addColumn($dataTableActionsColumn);

        $dataTable->addButton(route('classrooms.homeworks.create', $classroom), __('messages.homework_index_create_button'));

        return $dataTable->response();
    }

    public function create(Classroom $classroom)
    {
        //        $this->authorize('create', [Homework::class]);

        $this->addBaseBreadcrumbs($classroom);
        $this->addBreadcrumbItem(__('messages.breadcrumbs_homework_create'), route('classrooms.homeworks.create', $classroom), true);

        $dataForm = DataForm::make(__('messages.homework_create_title'), 'POST', route('classrooms.homeworks.store', $classroom), route('classrooms.homeworks.index', $classroom));

        $query = GameType::query()->select('title', 'id AS value')->orderBy('title')->get();
        $dataForm->addInput(DataFormInput::text(__('messages.homework_create_name_title'), 'name', true, 3, 255));
        $dataForm->addInput(DataFormInput::select(__('messages.homework_create_game_type_id_title'), 'game_type_id', true, $query));
        $dataForm->addInput(DataFormInput::component('homework.difficulty_select', ['difficulties' => Difficulty::query()->orderBy('title')->get()]));
        $dataForm->addInput(DataFormInput::number(__('messages.homework_create_games_required_title'), 'games_required', true, 1, 10));
        $dataForm->addInput(DataFormInput::datetime(__('messages.homework_create_available_at_title'), 'available_at', true, now()->addMinutes(1)));
        $dataForm->addInput(DataFormInput::datetime(__('messages.homework_create_finished_at_title'), 'finished_at', true, now()->addHour()));

        return $dataForm->response();
    }

    public function store(Request $request, Classroom $classroom)
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
        $homework->classroom()->associate($classroom);
        $homework->save();
        foreach ($classroom->users as $user) {
            $homework->addUser($user);
        }
        $homework->createGames();

        return redirect()->route('classrooms.homeworks.index', $classroom);
    }

    public function show(Classroom $classroom, Homework $homework)
    {
        $this->addBaseBreadcrumbs($classroom);
        $this->addBreadcrumbItem($homework->name, route('classrooms.homeworks.show', [$classroom, $homework]), true);

        $editRoute = auth()->user()->can('update', $homework) ? route('classrooms.homeworks.edit', [$classroom, $homework]) : null;
        $destroyRoute = auth()->user()->can('delete', $homework) ? route('classrooms.homeworks.destroy', [$classroom, $homework]) : null;

        $dataView = DataView::make($editRoute, $destroyRoute);
        $dataView->setTitle(__('messages.homework_show_title', [$homework->name]));

        $dataView->addItem(DataViewItem::text(__('messages.homework_show_available_at'), $homework->available_at->format('j. n. Y G:i'), 'col-6'));
        $dataView->addItem(DataViewItem::text(__('messages.homework_show_finished_at'), $homework->finished_at->format('j. n. Y G:i'), 'col-6'));
        $dataView->addItem(DataViewItem::text(__('messages.homework_show_game_type'), $homework->gameType->title, 'col-4'));
        $dataView->addItem(DataViewItem::text(__('messages.homework_show_difficulty'), $homework->difficulty->description, 'col-4'));
        $dataView->addItem(DataViewItem::text(__('messages.homework_show_games_required'), $homework->games_required, 'col-4'));

        $dataView->addItem(DataViewItem::category(__('messages.homework_show_students_title'), 'col-12'));
        foreach ($homework->users as $user) {
            $dataView->addItem(DataViewItem::text(__('messages.homework_show_students_name'), $user->name, 'col-4'));
            $dataView->addItem(DataViewItem::text(__('messages.homework_show_students_finished_games'), $homework->countGamesOf($user) . "/" . $homework->games_required, 'col-4'));
            $dataView->addItem(DataViewItem::text(__('messages.homework_show_students_score'), $homework->scoreOf($user), 'col-4'));
        }
        $dataView->addItem(DataViewItem::category(__('messages.homework_show_games_title'), 'col-12'));
        foreach ($homework->games as $i => $game) {
            $dataView->addItem(DataViewItem::category(__('messages.homework_show_game_title', [$i + 1]), 'col-6'));

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
        }

        return $dataView->response();
    }

    public function edit(Classroom $classroom, Homework $homework)
    {
        $this->addBaseBreadcrumbs($classroom);
        $this->addBreadcrumbItem($homework->name, route('classrooms.homeworks.show', [$classroom, $homework]), true);
        $this->addBreadcrumbItem(__('messages.breadcrumbs_homework_edit'), route('classrooms.homeworks.edit', [$classroom, $homework]), true);

        $dataForm = DataForm::make(__('messages.homework_edit_title'), 'PUT', route('classrooms.homeworks.update', [$classroom, $homework]), route('classrooms.homeworks.index', $classroom));

        $dataForm->addInput(DataFormInput::text(__('messages.homework_edit_name_title'), 'name', true, 3, 255, $homework->name));
        $dataForm->addInput(DataFormInput::datetime(__('messages.homework_edit_available_at_title'), 'available_at', true, $homework->available_at));
        $dataForm->addInput(DataFormInput::datetime(__('messages.homework_edit_finished_at_title'), 'finished_at', true, $homework->finished_at));

        return $dataForm->response();
    }

    public function update(Request $request, Classroom $classroom, Homework $homework)
    {
        $data = $request->validate([
            'name' => 'required',
            'available_at' => 'required|date',
            'finished_at' => 'required|date',
        ]);

        $homework->update($data);

        return redirect()
            ->route('classrooms.homeworks.show', [$classroom, $homework])
            ->with('status', __('messages.homework_update_success'));
    }

    public function recreateExercise(Exercise $exercise)
    {
        $exercise
            ->recreate();
        return redirect()->back();
    }

    public function destroy(Classroom $classroom, Homework $homework)
    {
        $homework->delete();

        return redirect()
            ->route('classrooms.homeworks.index', $classroom)
            ->with('status', __('messages.homework_destroy_success'));
    }
}