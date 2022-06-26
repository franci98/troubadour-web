<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function showSelect()
    {
        $classrooms = Auth::user()->teachersClassrooms;

        return view('classroom.select', compact('classrooms'));
    }

    public function select(Request $request, Classroom $classroom)
    {
        $this->selectClassroom($classroom->id);

        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $classroom = new Classroom($data);
        $classroom->user()->associate(Auth::user());
        $classroom->school()->associate(Auth::user()->school_id);
        $classroom->save();
        $this->selectClassroom($classroom->id);

        return redirect()->route('home');
    }
}
