<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_UsersController extends Controller
{
    public function index()
    {
        return view('layout-dashboard.user.users');
    }
}

 