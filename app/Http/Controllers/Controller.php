<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $classroom;

    public function __construct()
    {
        if (request()->session()->has('classroom')) {
            $this->classroom = Classroom::query()->find(request()->session()->get('classroom'));
        }
    }
}
