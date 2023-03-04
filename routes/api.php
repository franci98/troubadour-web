<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'v3',
    'as' => 'api.',
    'namespace' => 'API\v3',
], function () {
    Route::post('/register', 'Auth\AuthController@register');
    Route::post('/login', 'Auth\AuthController@login');
    Route::get('/users/leaderboard', 'UserController@leaderboard');

    Route::post('/forgot-password', 'Auth\AuthController@resetLinkSend')->middleware('guest')->name('password.email');
    Route::apiResource('schools', 'SchoolController')->only(['index']);

    Route::middleware('auth:sanctum')->get('/users/me', 'Auth\AuthController@currentUser');
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('answers', 'AnswerController')->only(['store']);
        Route::apiResource('game-types', 'GameTypeController')->only(['index']);
        Route::apiResource('game-types.difficulties', 'GameType\DifficultyController')->only(['index']);
        Route::apiResource('game-types.difficulty-categories', 'GameType\DifficultyCategoryController')->only(['index']);
        Route::apiResource('games', 'GameController')->only(['show', 'store']);
        Route::apiResource('classrooms', 'Classroom\ClassroomController')->only(['index']);
        Route::apiResource('badges', 'BadgeController')->only(['index']);
        Route::apiResource('levels', 'LevelController')->only(['index']);
        Route::apiResource('classrooms.homeworks', 'Classroom\HomeworkController')->only(['index', 'show']);
    });
});
