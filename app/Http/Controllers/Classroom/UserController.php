<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function addBaseBreadcrumbs(Classroom $classroom)
    {
        $this->addBreadcrumbItem($classroom->name, route('classrooms.show', $classroom));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_classroom_user_index'), route('classrooms.users.index', $classroom));
    }

    public function index(Request $request, Classroom $classroom)
    {
        $this->authorize('view', $classroom);

        $this->addBaseBreadcrumbs($classroom);
        $this->shareBreadcrumbs();

        $query = $classroom->users();

        $dataTable = DataTable::make(__('messages.classroom_users_index_title'), $request, $query);

        $dataTable->addColumn(DataTableColumn::component('user-avatar', '', false, false, 'user.avatar-column', fn($item) => []));
        $dataTable->addColumn(DataTableColumn::text('name', __('messages.name'), true, true, fn($item) => $item->name, fn($item) => $item->email));

        $dataTable->addButton(route('classrooms.users.create', $classroom), __('messages.classroom_users_index_button_add'));

        return $dataTable->response();
    }

    public function create(Classroom $classroom)
    {
        $this->authorize('update', $classroom);
        $this->addBaseBreadcrumbs($classroom);
        $this->addBreadcrumbItem(__('messages.breadcrumbs_classroom_user_create'), route('classrooms.users.create', $classroom), true);


        $dataForm = DataForm::make(__('messages.classroom_users_create_title'), 'POST', route('classrooms.users.store', $classroom), route('classrooms.users.index', $classroom));

        $dataForm->addInput(DataFormInput::select(__('messages.classroom_users_create_user'), 'user_id', true, User::query()->select('name AS title', 'id AS value')->get()));

        return $dataForm->response();
    }

    public function store(Request $request, Classroom $classroom)
    {
        $this->authorize('update', $classroom);
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $classroom->users()->attach($request->user_id);

        return redirect()->route('classrooms.users.index', $request->classroom)->with('success', __('messages.classroom_users_store_success'));
    }

    public function destroy()
    {

    }
}
