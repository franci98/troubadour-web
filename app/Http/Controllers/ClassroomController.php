<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function showSelect()
    {
        $classrooms = request()->user()->classrooms;
        return view('classroom.select', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $classroom = new Classroom($data);
        $classroom->user()->associate(Auth::user());
        $classroom->save();

        return redirect()->route('classrooms.select.show');
    }
}
