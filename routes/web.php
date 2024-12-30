<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserStatus;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::middleware(CheckUserStatus::class)->group(function () {
        Route::get('', [HomeController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

        //organisations
        Route::controller(OrganisationController::class)->prefix('organisations')->group(function () {
            Route::get('', 'index')->name('organisations');
            Route::get('show/{id}', 'show')->name('organisation.show');
            Route::get('create', 'create')->name('organisations.create');
            Route::post('store', 'store')->name('organisations.store');
            Route::get('edit/{id}', 'edit')->name('organisation.edit');
            Route::put('edit/{id}', 'update')->name('organisation.update');
            Route::delete('destroy/{id}', 'destroy')->name('organisation.destroy');
        });

        //users
        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('', 'index')->name('users');
            Route::get('show/{id}', 'show')->name('users.show');
            Route::get('create', 'create')->name('users.create');
            Route::post('store', 'store')->name('users.store');
            Route::get('edit/{id}', 'edit')->name('users.edit');
            Route::put('edit/{id}', 'update')->name('users.update');
            Route::delete('destroy/{id}', 'destroy')->name('users.destroy');
        });


        //accounts 
        Route::controller(AccountController::class)->prefix('accounts')->group(function () {
            Route::get('', 'index')->name('accounts');
            Route::get('show/{id}', 'show')->name('accounts.show');
            Route::get('create', 'create')->name('accounts.create');
            Route::post('store', 'store')->name('accounts.store');
            Route::get('edit/{id}', 'edit')->name('accounts.edit');
            Route::put('edit/{id}', 'update')->name('accounts.update');
            Route::delete('destroy/{id}', 'destroy')->name('accounts.destroy');
            // Route::get('{organisationId}/accounts', 'getAccountsByOrganisation');
        });

        Route::get('organisations/{organisationId}/accounts', [AccountController::class, 'getAccountsByOrganisation']);


        // Departmentsweb
        Route::controller(DepartmentController::class)->prefix('departments')->group(function () {
            Route::get('', 'index')->name('departments');
            Route::get('show/{id}', 'show')->name('departments.show');
            Route::get('create', 'create')->name('departments.create');
            Route::post('store', 'store')->name('departments.store');
            Route::get('edit/{id}', 'edit')->name('departments.edit');
            Route::put('edit/{id}', 'update')->name('departments.update');
            Route::delete('destroy/{id}', 'destroy')->name('departments.destroy');
        });

        // Services
        Route::controller(ServiceController::class)->prefix('services')->group(function () {
            Route::get('', 'index')->name('services');
            Route::get('show/{id}', 'show')->name('services.show');
            Route::get('create', 'create')->name('services.create');
            Route::post('store', 'store')->name('services.store');
            Route::get('edit/{id}', 'edit')->name('services.edit');
            Route::put('edit/{id}', 'update')->name('services.update');
            Route::delete('destroy/{id}', 'destroy')->name('services.destroy');
        });
        //tickets
        Route::controller(TicketController::class)->prefix('tickets')->group(function () {
            Route::get('', 'index')->name('tickets');
            Route::get('show/{id}', 'show')->name('tickets.show');
            Route::delete('destroy/{id}', 'destroy')->name('tickets.destroy');
        });
        // Profile

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::post('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
    });
});
