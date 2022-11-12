<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $this->shareBreadcrumbs();
        return view('super-admin.index');
    }

    public function settings()
    {
        return view('super-admin.settings');
    }
}
