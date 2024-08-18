<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route Home Page
Route::get('/', function () {
    return redirect('/login');
});

// Route Auth Page
Route::get('/login', [AuthController::class, 'get_login_page']);
Route::get('/logout', [AuthController::class, 'logout_page']);
Route::get('/register', [AuthController::class, 'get_register_page']);

// Route Admin Page
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('admin/dashboard', [AdminController::class, 'get_dashboard_admin'])->name('admin.dashboard');
});

// Route User Page
Route::group(['middleware' => ['role:user']], function () {
    Route::get('user/dashboard', [UserController::class, 'get_dashboard_user'])->name('user.dashboard');
});