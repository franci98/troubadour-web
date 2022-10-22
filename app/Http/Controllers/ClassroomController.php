<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Game;
use App\Models\GameUser;
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index()
    {
        if (Auth::user()->teachersClassrooms()->exists())
            return redirect()
                ->route('classrooms.show', \auth()->user()->teachersClassrooms->first());
        else
            return redirect()
                ->route('classrooms.create');
    }

    public function show(Classroom $classroom)
    {
        $this->addBreadcrumbItem($classroom->name, route('classrooms.show', $classroom), true);

        $homeworks = Homework::query()
            ->where('classroom_id', $classroom->id)
            ->whereDate('available_at', '>', now()->subWeek())
            ->get();

        $gameUsers = GameUser::query()
            ->whereIn('game_id', Game::query()->whereIn('homework_id', $homeworks->pluck('id'))->pluck('id'))
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', compact('classroom', 'homeworks', 'gameUsers'));
    }

    public function create()
    {
        return view('classroom.create');
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

        return redirect()->route('classrooms.show', $classroom);
    }
}
