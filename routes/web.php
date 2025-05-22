<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;

Auth::routes();

Route::any('/admin', [LoginController::class, 'showLoginForm'])->name('admin');
Route::any('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::any('/check/login', [LoginController::class, 'login']);



Route::any('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
});