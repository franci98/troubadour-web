<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function invalid()
    {
        return view('role.invalid');
    }
}
