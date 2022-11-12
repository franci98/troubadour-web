<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Utilities\DataForm;
use App\Utilities\DataFormInput;
use App\Utilities\DataTable;
use App\Utilities\DataTableColumn;
use App\Utilities\DataTableColumnAction;
use App\Utilities\DataView;
use App\Utilities\DataViewItem;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumbItem(__('messages.breadcrumbs_super_admin_index'), route('super-admin.index'));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_user_index'), route('users.index'));
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $this->shareBreadcrumbs();

        if (auth()->user()->isSuperAdmin()) {
            $query = User::query()
                ->orderBy('name');
        } else if (auth()->user()->isSchoolAdmin()) {
            $query = User::query()
                ->where('school_id', auth()->user()->school_id)
                ->orderBy('name');
        } else {
            abort(403);
        }

        $dataTable = DataTable::make(__('messages.user_index_title'), $request, $query);

        $dataTable->addColumn(DataTableColumn::text('name', __('messages.user_index_column_name'), true, true, fn($item) => $item->name));
        $dataTable->addColumn(DataTableColumn::text('email', __('messages.user_index_column_email'), true, true, fn($item) => $item->email));
        $dataTable->addColumn(DataTableColumn::text('school.name', __('messages.user_index_column_school'), true, true, fn($item) => $item->school->name));
        $dataTable->addColumn(DataTableColumn::text('created_at', __('messages.user_index_column_created_at'), true, false, fn($item) => $item->created_at->format('j. n. Y')));

        $actionsColumn = DataTableColumn::actions();
        $actionsColumn->addAction(DataTableColumnAction::normal(__('messages.user_index_column_action_show'), fn($item) => route('users.show', $item->id)));
        $dataTable->addColumn($actionsColumn);

        $dataTable->addButton(route('users.create'), __('messages.user_index_button_create'));

        return $dataTable->response();
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $this->addBreadcrumbItem(__('messages.breadcrumbs_user_create'), route('users.create'), true);

        $postRoute = route('users.store');
        $cancelRoute = route('users.index');
        $dataForm = DataForm::make(__('messages.user_create_title'), 'POST', $postRoute, $cancelRoute);

        $dataForm->addInput(DataFormInput::text(__('messages.user_create_input_name'), 'name', true, 0, 1024));
        $dataForm->addInput(DataFormInput::email(__('messages.user_create_input_email'), 'email', true, 0, 1024));

        if (auth()->user()->isSuperAdmin()) {
            $options = School::query()
                ->select('id AS value', 'name AS title')
                ->orderBy('name')
                ->get();
            $dataForm->addInput(DataFormInput::select(__('messages.user_create_input_school'), 'school_id', true, $options));
        }

        return $dataForm->response();
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|string|max:1024',
            'email' => 'required|string|email|max:1024|unique:users',
            'school_id' => 'nullable|exists:schools,id',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->school_id = $request->input('school_id') ?: auth()->user()->school_id;
        $user->password = 'NotSet';
        $user->save();

        $user->sendEmailVerificationNotification();

        return redirect()
            ->route('users.show', $user->id)
            ->with('status', __('messages.user_store_success'));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $this->addBreadcrumbItem($user->name, route('users.show', $user->id), true);
        $this->shareBreadcrumbs();

        $editRoute = route('users.edit', $user->id);
        $deleteRoute = route('users.destroy', $user->id);
        $dataView = DataView::make($editRoute, $deleteRoute);

        $dataView->setTitle($user->name);

        $dataView->addItem(DataViewItem::text(__('messages.user_show_item_name'), $user->name, 'col-12 col-md-6'));
        $dataView->addItem(DataViewItem::text(__('messages.user_show_item_email'), $user->email, 'col-12 col-md-6'));
        $dataView->addItem(DataViewItem::text(__('messages.user_show_item_school'), $user->school->name, 'col-12 col-md-6'));
        $dataView->addItem(DataViewItem::text(__('messages.user_show_item_created_at'), $user->created_at->format('j. n. Y'), 'col-12 col-md-6'));

        return $dataView->response();
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $this->addBreadcrumbItem($user->name, route('users.show', $user->id));
        $this->addBreadcrumbItem(__('messages.breadcrumbs_user_edit'), route('users.edit', $user->id), true);

        $postRoute = route('users.update', $user->id);
        $cancelRoute = route('users.show', $user->id);
        $dataForm = DataForm::make(__('messages.user_edit_title', [$user->name]), 'PUT', $postRoute, $cancelRoute);

        $dataForm->addInput(DataFormInput::text(__('messages.user_edit_input_name'), 'name', true, 0, 1024, $user->name));
        $dataForm->addInput(DataFormInput::email(__('messages.user_edit_input_email'), 'email', true, 0, 1024, $user->email));

        if (auth()->user()->isSuperAdmin()) {
            $options = School::query()
                ->select('id AS value', 'name AS title')
                ->orderBy('name')
                ->get();
            $dataForm->addInput(DataFormInput::select(__('messages.user_edit_input_school'), 'school_id', true, $options, $user->school_id));
        }

        return $dataForm->response();
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => 'required|string|max:1024',
            'email' => 'required|string|email|max:1024|unique:users,email,' . $user->id,
            'school_id' => 'nullable|exists:schools,id',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if (request()->get('school_id') != null)
            $user->school_id = $request->input('school_id');

        $user->save();

        return redirect()
            ->route('users.show', $user->id)
            ->with('status', __('messages.user_update_success'));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', __('messages.user_destroy_success'));
    }
}
