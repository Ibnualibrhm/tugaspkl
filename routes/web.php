<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin_DashboardController;
use App\Http\Controllers\Admin_CategoryController;
use App\Http\Controllers\Admin_UsersController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard',[Admin_DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/category',[Admin_CategoryController::class, 'index'])->name('admin.category');
    Route::post('/admin/category/tambah',[Admin_CategoryController::class, 'TambahDataCategory'])->name('admin.TambahDataCategory');
    Route::post('/admin/category/hapus',[Admin_CategoryController::class, 'hapusDataCategory'])->name('admin.hapusDataCategory');
    Route::post('/admin/category/edit',[Admin_CategoryController::class, 'editDataCategory'])->name('admin.editDataCategory');

    Route::get('/admin/users',[Admin_UsersController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/tambah',[Admin_UsersController::class, 'TambahDataUsers'])->name('admin.TambahDataUsers');
    Route::post('/admin/users/hapus',[Admin_UsersController::class, 'hapusDataUsers'])->name('admin.hapusDataUsers');
    Route::post('/admin/users/edit',[Admin_UsersController::class, 'editDataUsers'])->name('admin.editDataUsers');
});