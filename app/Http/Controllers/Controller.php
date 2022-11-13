<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $breadcrumbs = [];

    public function __construct()
    {
        if (auth()->check()) {
            if (auth()->user()->isSuperAdmin()) {
                $this->addBreadcrumbItem(__('messages.breadcrumbs_super_admin_index'), route('super-admin.index'));
            } elseif (auth()->user()->isSchoolAdmin()) {
                $this->addBreadcrumbItem(auth()->user()->school->name, route('schools.show', auth()->user()->school));
            } elseif (auth()->user()->isTeacher()) {
                $this->addBreadcrumbItem(__('messages.breadcrumbs_teacher_index'), route('teacher.index'));
            }
        }
    }

    protected function addBreadcrumbItem($title, $href, $isLastRecord = false)
    {
        $this->breadcrumbs[] = [
            'title' => $title,
            'href' => $href
        ];
        if ($isLastRecord)
            $this->shareBreadcrumbs();
    }

    public function shareBreadcrumbs()
    {
        View::share('breadcrumbs', $this->breadcrumbs);
    }
}
