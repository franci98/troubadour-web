<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\School;
use App\Models\User;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumbItem(__('messages.breadcrumbs_super_admin_index'), route('super-admin.index'));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_school_index'), route('schools.index'));
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', School::class);
        $this->shareBreadcrumbs();

        $query = School::query()
            ->orderBy('name');

        $dataTable = DataTable::make(__('messages.school_index_title'), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('name', __('messages.school_index_column_name'), true, true, fn($item) => $item->name));
        $dataTable->addColumn(DataTableColumn::text('users_count', __('messages.school_index_column_users_count'), false, false, fn($item) => $item->users()->count() . ' ' . __('messages.school_index_column_users_count_suffix'), fn($item) => $item->classrooms()->count() . ' ' . __('messages.school_index_column_classrooms_count_suffix')));
        $dataTable->addColumn(DataTableColumn::text('created_at', __('messages.school_index_column_created_at'), true, false, fn($item) => $item->created_at->format('j. n. Y')));

        $actionsColumn = DataTableColumn::actions();
        $actionsColumn->addAction(DataTableColumnAction::normal(__('messages.school_index_column_action_show'), fn($item) => route('schools.show', $item->id)));
        $actionsColumn->addAction(DataTableColumnAction::destructive(__('messages.school_index_column_action_delete'), fn($item) => route('schools.destroy', $item->id)));
        $dataTable->addColumn($actionsColumn);

        $dataTable->addButton(route('schools.create'), __('messages.school_index_button_create'));

        return $dataTable->response();
    }

    public function create()
    {
        $this->authorize('create', School::class);
        $this->addBreadcrumbItem(__('messages.breadcrumbs_school_create'), route('schools.create'), true);

        $postRoute = route('schools.store');
        $cancelRoute = route('schools.index');
        $dataForm = DataForm::make(__('messages.school_create_title'), 'POST', $postRoute, $cancelRoute);

        $dataForm->addInput(DataFormInput::text(__('messages.school_create_input_name'), 'name', true, 0, 1024));
        $users = User::query()
            ->select('id AS value', 'name AS title')
            ->where('school_id', School::NO_SCHOOL_ID)
            ->whereDoesntHave('roles', fn($query) => $query->where('roles.id', Role::SUPER_ADMIN))
            ->orderBy('name')
            ->get();
        $dataForm->addInput(DataFormInput::select(__('messages.school_create_input_school_admin'), 'school_admin_id', false, $users));

        return $dataForm->response();
    }

    public function store(Request $request)
    {
        $this->authorize('create', School::class);

        $request->validate([
            'name' => 'required|string|max:1024',
            'school_admin_id' => 'nullable|exists:users,id',
        ]);

        $school = School::query()->create([
            'name' => $request->input('name'),
        ]);

        if ($request->get('school_admin_id') != null) {
            $schoolAdmin = User::query()->findOrFail($request->input('school_admin_id'));
            $schoolAdmin->school_id = $school->id;
            $schoolAdmin->save();
            $schoolAdmin->assignRole(Role::SCHOOL_ADMIN, RoleUser::STATUS_ACTIVE);
        }

        return redirect()
            ->route('schools.show', $school)
            ->with('status', __('messages.school_store_success'));
    }

    public function show(School $school)
    {
        $this->authorize('view', $school);
        $this->addBreadcrumbItem($school->name, route('schools.show', $school), true);

        return view('school.show', ['school' => $school,]);
    }

    public function edit(School $school)
    {
        $this->authorize('update', $school);

        $this->addBreadcrumbItem($school->name, route('schools.show', $school));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_school_edit'), route('schools.edit', $school), true);

        $editRoute = route('schools.update', $school);
        $cancelRoute = route('schools.show', $school);
        $dataForm = DataForm::make(__('messages.school_edit_title', [$school->name]), 'PUT', $editRoute, $cancelRoute);

        $dataForm->addInput(DataFormInput::text(__('messages.school_edit_input_name'), 'name', true, 0, 1024, $school->name));
        $users = User::query()
            ->select('id AS value', 'name AS title')
            ->where('school_id', School::NO_SCHOOL_ID)
            ->whereDoesntHave('roles', fn($query) => $query->where('roles.id', Role::SUPER_ADMIN))
            ->orderBy('name')
            ->get();
        $dataForm->addInput(DataFormInput::select(__('messages.school_edit_input_school_admin'), 'school_admin_id', false, $users, $school->schoolAdmin()->first()?->id));

        return $dataForm->response();
    }

    public function update(Request $request, School $school)
    {
        $this->authorize('update', $school);

        $request->validate([
            'name' => 'required|string|max:1024',
            'school_admin_id' => 'nullable|exists:users,id',
        ]);

        $school->name = $request->input('name');
        $school->save();

        if ($request->get('school_admin_id') != null) {
            $schoolAdmin = User::query()->findOrFail($request->input('school_admin_id'));
            $schoolAdmin->school_id = $school->id;
            $schoolAdmin->save();
            $schoolAdmin->assignRole(Role::SCHOOL_ADMIN, RoleUser::STATUS_ACTIVE);
        }

        return redirect()
            ->route('schools.show', $school)
            ->with('status', __('messages.school_update_success'));
    }

    public function destroy(School $school)
    {
        $this->authorize('delete', $school);

        $school->users()->update(['school_id' => School::NO_SCHOOL_ID]);
        $school->delete();

        return redirect()
            ->route('schools.index')
            ->with('status', __('messages.school_destroy_success'));
    }
}
