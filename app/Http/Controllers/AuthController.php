<?php

namespace App\Http\Controllers;

use App\Mail\SuccessfulRegistrationMail;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('login')->with('status', __('messages.email_verified'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('status', __('messages.login_failed'));
        }
    }

    public function showRegisterForm()
    {
        $schools = School::all();

        return view('auth.register', compact('schools'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'school_id' => 'required|exists:schools,id',
            'password' => 'required|confirmed|min:6'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::query()->create($data);

        $user->assignRole(Role::TEACHER);
        $user->sendEmailVerificationNotification();

        return Redirect::to("login");
    }

    public function terms()
    {
        return view('terms');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login.show');
    }
}
