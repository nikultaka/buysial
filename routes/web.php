<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\ProfileController;

Auth::routes();

Route::any('/admin', [LoginController::class, 'showLoginForm'])->name('admin');
Route::any('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::any('/check/login', [LoginController::class, 'login']);


Route::any('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Company Management Routes
    Route::get('/company', [CompanyController::class, 'index'])->name('admin.company');
    Route::post('/company/save', [CompanyController::class, 'save'])->name('admin.company.create');
    Route::post('/companylist', [CompanyController::class, 'list'])->name('admin.company.list');
    Route::post('/company/delete', [CompanyController::class, 'delete'])->name('admin.company.delete');
    Route::get('/company/edit', [CompanyController::class, 'edit'])->name('admin.company.edit');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
});
