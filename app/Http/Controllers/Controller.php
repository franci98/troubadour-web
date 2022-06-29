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

    protected $classroom;
    protected $breadcrumbs = [];

    public function __construct()
    {
        if (request()->session()->has('classroom')) {
            $this->classroom = Classroom::query()->find(request()->session()->get('classroom'));
        }
        View::share('classroom', $this->classroom);
    }

    public function selectClassroom(int $classroomId)
    {
        request()->session()->put('classroom', $classroomId);
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
