<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class Admin_CategoryController extends Controller
{
        public function index()
    {
        $data = category::select('id','name','is_publish')->get();

        return view('layout-dashboard.category.index', [
            'title' => 'Ini Category'
        ], compact('data'));
    }
}

