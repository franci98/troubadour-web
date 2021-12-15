<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function verifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return view('');
    }
}
