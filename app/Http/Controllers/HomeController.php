<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        $classroom= $this->classroom;
        $homeworks = Homework::query()->whereDate('available_at', '>', now()->subWeek())->get();
        return view('dashboard', compact('classroom', 'homeworks'));
    }
}
