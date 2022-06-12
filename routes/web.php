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

Route::middleware(['auth'])->group(function () {
    Route::get('/classrooms/select', 'ClassroomController@select')->name('classrooms.select');
    Route::get('/dashboard', 'ClassroomController@select')->name('home');
});


Route::get('/email/verify/{id}/{hash}', 'AuthController@verifyEmail')->middleware(['signed'])->name('verification.verify');
