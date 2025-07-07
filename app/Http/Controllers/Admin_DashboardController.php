<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
