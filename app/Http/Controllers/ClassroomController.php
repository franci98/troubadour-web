<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function select()
    {
        $user = Auth::user()->classrooms();
        return view('classroom.select');
    }
}
