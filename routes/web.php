<?php

use App\Helpers\GlobalHelper;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\GeneralSettingController;

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

    Route::post('/profile/remove-logo', [ProfileController::class, 'removeLogo'])->name('admin.profile.removeLogo');


    // General setting
    Route::get('/general-settings', [GeneralSettingController::class, 'index'])->name('admin.general_settings');
    Route::post('/settings/update', [GeneralSettingController::class, 'update'])->name('admin.settings.update');
    Route::get('/settings/remove_logo', [GeneralSettingController::class, 'removeLogo'])->name('admin.settings.remove_logo');
    Route::get('/settings/remove_favicon', [GeneralSettingController::class, 'removeFavicon'])->name('admin.settings.remove_favicon');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/users/save', [UserController::class, 'save'])->name('admin.users.save');
    Route::post('/users/userList', [UserController::class, 'userList'])->name('admin.users.userList');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('admin.users.delete');


    // Country and state routes
    Route::get('/get-states/{country_id}', function ($country_id) {
        return response()->json(GlobalHelper::getStatesByCountry($country_id));
    });
    Route::get('/get-cities/{state_id}', function ($state_id) {
        return response()->json(GlobalHelper::getCitiesByState($state_id));
    });


});
