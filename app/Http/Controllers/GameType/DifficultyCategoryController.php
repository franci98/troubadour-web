<?php

namespace App\Http\Controllers\GameType;

use App\Http\Controllers\Controller;
use App\Models\Difficulty;
use App\Models\Game;
use App\Models\GameType;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use Illuminate\Http\Request;

class DifficultyCategoryController extends Controller
{
    private function addBaseBreadcrumbs(GameType $gameType) {
        $this->addBreadcrumbItem(__('messages.breadcrumbs_game_type_index'), route('super-admin.game-types.index'));
        $this->addBreadcrumbItem($gameType->title, route('super-admin.game-types.index', $gameType));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_difficulty_categories_index'), route('super-admin.game-types.difficulty-categories.index', $gameType));
    }


    public function index(Request $request, GameType $gameType)
    {
        $this->addBaseBreadcrumbs($gameType);
        $this->shareBreadcrumbs();

        $query = $gameType
            ->difficultyCategories()
            ->orderBy('sequence');

        $dataTable = DataTable::make(__('messages.difficulty_categories_index_title', [$gameType->title]), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('id', '#', true, true, fn($item) => $item->id));
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.difficulty_categories_index_column_title'), true, true, fn($item) => $item->name, fn($item) => $item->description));

        $dataTable->addButton(route('super-admin.game-types.difficulty-categories.create', $gameType), __('messages.difficulty_categories_create_title', [$gameType->title]));

        return $dataTable->response();
    }

    public function create(GameType $gameType)
    {
        $this->addBaseBreadcrumbs($gameType);
        $this->shareBreadcrumbs();

        $dataForm = DataForm::make(__('messages.difficulty_categories_create_title', [$gameType->title]), 'POST', route('super-admin.game-types.difficulty-categories.store', $gameType), route('super-admin.game-types.difficulty-categories.index', $gameType));

        $dataForm->addInput(DataFormInput::text(__('messages.difficulty_categories_title'), 'name', true, 1, 255));
        $dataForm->addInput(DataFormInput::textarea(__('messages.difficulty_categories_description'), 'description', true, 0, 1024, 3));

        return $dataForm->response();
    }

    public function store(GameType $gameType)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1024',
        ]);

        $gameType->difficultyCategories()->create($data);

        return redirect()
            ->route('super-admin.game-types.difficulty-categories.index', $gameType);
    }

    public function difficultiesAdd(Request $request, GameType $gameType)
    {
        $this->addBaseBreadcrumbs($gameType);
        $this->shareBreadcrumbs();

        $data = $request->validate([
            'difficulty_id' => 'required|array',
            'difficulty_id.*' => 'required|integer|exists:difficulties,id',
        ]);

        $dataForm = DataForm::make(__('messages.difficulty_categories_difficulties_create_title', [$gameType->title]), 'POST', route('super-admin.game-types.difficulty-categories.difficulties.store', [$gameType]), route('super-admin.game-types.difficulties.index', $gameType));

        $names = [];
        foreach ($data['difficulty_id'] as $i => $difficultyId) {
            $difficulty = Difficulty::withTrashed()->findOrFail($difficultyId);
            $names[] = $difficulty->title;
            $dataForm->addInput(DataFormInput::hidden('','difficulty_id[' . $i . ']', $difficultyId));
        }
        $dataForm->addInput(DataFormInput::info(__('messages.difficulty_categories_difficulties_create_info'), implode(', ', $names)));

        $difficultyCategories = $gameType
            ->difficultyCategories()
            ->select('id AS value', 'name AS title')
            ->orderBy('sequence')
            ->get();
        $dataForm->addInput(DataFormInput::select(__('messages.difficulty_categories_difficulties_difficulty_category_id_title'), 'difficulty_category_id', true, $difficultyCategories));

        return $dataForm->response();
    }

    public function difficultiesStore(GameType $gameType)
    {
        $data = request()->validate([
            'difficulty_id' => 'required|array',
            'difficulty_id.*' => 'required|integer|exists:difficulties,id',
            'difficulty_category_id' => 'required|integer|exists:difficulty_categories,id',
        ]);

        $difficulties = Difficulty::withTrashed()->findMany($data['difficulty_id']);
        foreach ($difficulties as $difficulty) {
            $difficulty->difficultyCategory()->associate($data['difficulty_category_id']);
            $difficulty->save();
        }

        return redirect()
            ->route('super-admin.game-types.difficulties.index', $gameType);
    }
}
