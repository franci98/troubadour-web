<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Homework;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $this->shareBreadcrumbs();
        return view('teacher.index');
    }
}
