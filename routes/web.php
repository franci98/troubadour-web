<?php

use App\Http\Controllers\SuperAdminController;
use App\Models\Role;
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

Route::group([
    'prefix' => 'administracija',
], function () {
    Route::get('/', function () {
        return redirect()
            ->route('classrooms.index');
    });

    Route::get('terms', 'AuthController@terms')->name('terms');

    Route::middleware(['guest'])->group(function () {
        Route::get('login', 'AuthController@showLoginForm')->name('login.show');
        Route::post('login', 'AuthController@login')->name('login');

        Route::get('register', 'AuthController@showRegisterForm')->name('register.show');
        Route::post('register', 'AuthController@register')->name('register');

        Route::get('password/request', 'ForgotPasswordController@request')->name('password.request');
        Route::post('password/request', 'ForgotPasswordController@send')->name("password.send");
        Route::get('password/reset', 'AuthController@passwordResetShow')->name('password.change');
        Route::post('password/reset', 'AuthController@passwordUpdate')->name("password.reset");
    });
    Route::get('/email/verify/{id}/{hash}', 'AuthController@verifyEmail')->middleware(['signed'])->name('verification.verify');

    Route::group([
        'prefix' => 'teacher',
        'as' => '',
        'middleware' => ['auth', 'teacher'],
    ], function () {
        Route::post('logout', 'AuthController@logout')->name('logout')->withoutMiddleware('teacher');

        Route::resource('classrooms', 'ClassroomController');
        Route::resource('classrooms.users', 'Classroom\UserController')->only('index', 'create', 'store');
        Route::resource('classrooms.homeworks', 'Classroom\HomeworkController');
        Route::get('/roles/invalid', 'RoleController@invalid')->name('roles.invalid')->withoutMiddleware('teacher');
        Route::get('classrooms/{classroom}/dashboard', 'HomeController@dashboard')->name('home');
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

    // NEW ROUTES
    Route::group([
        'prefix' => 'super-admin',
        'as' => 'super-admin.',
        'middleware' => ['auth', 'role:' . Role::SUPER_ADMIN],
    ], function () {
        Route::get('/', [SuperAdminController::class, 'index'])->name('index');
    });
    Route::resource('schools', 'School\SchoolController');
    Route::resource('users', 'User\UserController');
});



