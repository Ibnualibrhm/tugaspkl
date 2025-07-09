<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class Admin_DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $totalCategories = \App\Models\Category::count();

        return view('dashboard', compact('totalUsers', 'totalCategories',));
    }
}
