<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('terms', 'AuthController@terms')->name('terms');

Route::middleware(['guest'])->group(function () {
    Route::get('login', 'AuthController@showLoginForm')->name('login.show');
    Route::post('login', 'AuthController@login')->name('login');

    Route::get('register', 'AuthController@showRegisterForm')->name('register.show');
    Route::post('register', 'AuthController@register')->name('register');

    Route::get('password/request', 'ForgotPasswordController@request')->name('password.request');
    Route::post('password/request', 'ForgotPasswordController@send')->name("password.send");
    Route::get('password/reset/{token}', 'ForgotPasswordController@change')->name('password.change');
    Route::post('password/reset', 'ForgotPasswordController@reset')->name("password.reset");
});

Route::group([
    'prefix' => 'teacher',
    'as' => '',
    'middleware' => ['auth', 'classroom-teacher'],
], function () {
    Route::get('/email/verify/{id}/{hash}', 'AuthController@verifyEmail')->middleware(['signed'])->name('verification.verify');
    Route::post('logout', 'AuthController@logout')->name('logout');

    Route::get('/classrooms/select', 'ClassroomController@showSelect')->name('classrooms.select.show')->withoutMiddleware(\App\Http\Middleware\EnsureClassroomIsSelected::class);
    Route::get('/classrooms/{classroom}/select', 'ClassroomController@select')->name('classrooms.select')->withoutMiddleware(\App\Http\Middleware\EnsureClassroomIsSelected::class);
    Route::resource('classrooms', 'ClassroomController')->withoutMiddleware(\App\Http\Middleware\EnsureClassroomIsSelected::class);
    Route::resource('classrooms.users', 'Classroom\UserController')->only('index', 'create', 'store');
    Route::resource('classrooms.homeworks', 'Classroom\HomeworkController');
    Route::get('/roles/invalid', 'RoleController@invalid')->name('roles.invalid')->withoutMiddleware('classroom-teacher');
    Route::get('/dashboard', 'HomeController@dashboard')->name('home');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'admin'],
], function () {
    Route::resource('game-types', 'GameType\GameTypeController');
    Route::get('game-types/{gameType}/restore', 'GameType\GameTypeController@restore')->name('game-types.restore');
    Route::resource('game-types.difficulties', 'GameType\DifficultyController');
    Route::get('game-types/{gameType}/difficulties/{difficulty}/restore', 'GameType\DifficultyController@restore')->name('game-types.difficulties.restore');
});

