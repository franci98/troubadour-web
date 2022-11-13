<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Game;
use App\Models\GameUser;
use App\Models\Homework;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $this->shareBreadcrumbs();
        $school = auth()->user()->school;

        $stats = [];
        // Games played
        $stats['games_played'] = Game::query()
            ->whereHas('users', fn($query) => $query->where('school_id', $school->id))
            ->count();

        // Games percent change in last 24 hours
        $gamesToday = GameUser::query()
            ->whereHas('user', fn($query) => $query->where('school_id', $school->id))
            ->where('created_at', '>=', now()->subDay())
            ->count();
        $gamesYesterday = GameUser::query()
            ->whereHas('user', fn($query) => $query->where('school_id', $school->id))
            ->where('created_at', '>=', now()->subDays(2))
            ->where('created_at', '<', now()->subDay())
            ->count();
        $stats['games_played_percentage'] = $gamesYesterday > 0 ? round(($gamesToday - $gamesYesterday) / $gamesYesterday * 100) : 0;

        // Users count
        $stats['users_count'] = User::query()
            ->where('school_id', $school->id)
            ->count();
        $usersToday = User::query()
            ->where('school_id', $school->id)
            ->where('created_at', '>=', now()->subDay())
            ->count();
        $usersYesterday = User::query()
            ->where('school_id', $school->id)
            ->where('created_at', '>=', now()->subDays(2))
            ->where('created_at', '<', now()->subDay())
            ->count();
        $stats['users_count_percentage'] = $usersYesterday > 0 ? round(($usersToday - $usersYesterday) / $usersYesterday * 100) : 0;

        // Schools count
        $stats['schools_count'] = School::query()->count();

        // Classrooms count
        $stats['classrooms_count'] = Classroom::query()
            ->whereHas('user', fn($query) => $query->where('school_id', $school->id))
            ->count();

        // Games per day for last week
        $chartGamesPerDay = [];
        for ($i = 7; $i >= 0; $i--) {
            $chartGamesPerDay['data'][] = GameUser::query()
                ->whereHas('user', fn($query) => $query->where('school_id', $school->id))
                ->where('created_at', '>=', now()->subDays($i))
                ->where('created_at', '<', now()->subDays($i - 1))
                ->count();
            $chartGamesPerDay['labels'][] = now()->subDays($i)->format('d.m');
        }
        $stats['games_per_day'] = $chartGamesPerDay;

        // Users per day for last week
        $chartUsersPerDay = [];
        for ($i = 7; $i >= 0; $i--) {
            $chartUsersPerDay['data'][] = User::query()
                ->where('school_id', $school->id)
                ->where('created_at', '>=', now()->subDays($i))
                ->where('created_at', '<', now()->subDays($i - 1))
                ->count();
            $chartUsersPerDay['labels'][] = now()->subDays($i)->format('d.m');
        }
        $stats['users_per_day'] = $chartUsersPerDay;


        return view('teacher.index', compact('stats', 'school'));
    }
}
