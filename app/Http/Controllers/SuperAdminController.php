<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Game;
use App\Models\GameUser;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $this->shareBreadcrumbs();

        $stats = [];
        // Games played
        $stats['games_played'] = Game::query()->count();

        // Games percent change in last 24 hours
        $gamesToday = GameUser::query()->where('created_at', '>=', now()->subDay())->count();
        $gamesYesterday = GameUser::query()->where('created_at', '>=', now()->subDays(2))->where('created_at', '<', now()->subDay())->count();
        $stats['games_played_percentage'] = $gamesYesterday > 0 ? round(($gamesToday - $gamesYesterday) / $gamesYesterday * 100) : 0;

        // Users count
        $stats['users_count'] = User::query()->count();
        $usersToday = User::query()->where('created_at', '>=', now()->subDay())->count();
        $usersYesterday = User::query()->where('created_at', '>=', now()->subDays(2))->where('created_at', '<', now()->subDay())->count();
        $stats['users_count_percentage'] = $usersYesterday > 0 ? round(($usersToday - $usersYesterday) / $usersYesterday * 100) : 0;

        // Schools count
        $stats['schools_count'] = School::query()->count();

        // Classrooms count
        $stats['classrooms_count'] = Classroom::query()->count();

        // Games per day for last week
        $chartGamesPerDay = [];
        for ($i = 7; $i >= 0; $i--) {
            $chartGamesPerDay['data'][] = GameUser::query()
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
                ->where('created_at', '>=', now()->subDays($i))
                ->where('created_at', '<', now()->subDays($i - 1))
                ->count();
            $chartUsersPerDay['labels'][] = now()->subDays($i)->format('d.m');
        }
        $stats['users_per_day'] = $chartUsersPerDay;

        return view('super-admin.index', compact('stats'));
    }

    public function settings()
    {
        return view('super-admin.settings');
    }
}
