<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\PermissionGroupController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\UploadsController;
use App\Http\Controllers\Web\FormEntryController;
use App\Http\Controllers\Web\User\UserController;
use App\Http\Controllers\Web\SummaryController;

Route::middleware(['auth'/*, 'verified'*/])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix("/location")->as("location.")->group(function () {
        Route::get('', [LocationController::class, 'index'])->name('index');
        Route::get('/create', [LocationController::class, 'create'])->name('create');
        Route::post('/', [LocationController::class, 'store'])->name('store');
        Route::get('/{location}', [LocationController::class, 'show'])->name('show');
        Route::get('/{location}/edit', [LocationController::class, 'edit'])->name('edit');
        Route::put('/{location}', [LocationController::class, 'update'])->name('update');
    });

    Route::prefix("/permission-groups")->as("permission-groups.")->group(function () {
        Route::get('', [PermissionGroupController::class, 'index'])->name('index');
        Route::get('/create', [PermissionGroupController::class, 'create'])->name('create');
        Route::post('/', [PermissionGroupController::class, 'store'])->name('store');
        Route::get('/{permissionGroups}', [PermissionGroupController::class, 'show'])->name('show');
        Route::get('/{permissionGroups}/edit', [PermissionGroupController::class, 'edit'])->name('edit');
        Route::put('/{permissionGroups}', [PermissionGroupController::class, 'update'])->name('update');
    });

    Route::prefix("/permissions")->as("permissions.")->group(function () {
        Route::get('', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/', [PermissionController::class, 'store'])->name('store');
        Route::get('/{permissions}', [PermissionController::class, 'show'])->name('show');
        Route::get('/{permissions}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/{permissions}', [PermissionController::class, 'update'])->name('update');
    });

    Route::prefix("/roles")->as("roles.")->group(function () {
        Route::get('', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{roles}', [RoleController::class, 'show'])->name('show');
        Route::get('/{roles}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{roles}', [RoleController::class, 'update'])->name('update');
    });
    //});

    Route::prefix("/users")->as("users.")->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{users}', [UserController::class, 'show'])->name('show');
        Route::get('/{users}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{users}', [UserController::class, 'update'])->name('update');
    });

    Route::prefix("/forms")->as("forms.")->group(function () {
        Route::get('/{formCode}/create', [FormEntryController::class, 'create'])
            ->name('create');
        Route::post('/{formCode}/store', [FormEntryController::class, 'store'])
            ->name('store');

        // Alias khusus untuk form tertentu
        Route::get('/rekapitulasi-kesalahan-bacaan/create', [FormEntryController::class, 'create'])
            ->defaults('formCode', 'rekapitulasi-kesalahan-bacaan')
            ->name('create.rekapitulasi-kesalahan-bacaan');

        Route::get('/rekapitulasi-kesalahan-bacaan/store', [FormEntryController::class, 'store'])
            ->defaults('formCode', 'rekapitulasi-kesalahan-bacaan')
            ->name('store.rekapitulasi-kesalahan-bacaan');
    });

    Route::prefix("/summaries")->as("summaries.")->group(function () {
        Route::get('{formCode}', [SummaryController::class, 'index'])->name('index');
        Route::get('{formCode}/{entryId}', [SummaryController::class, 'show'])->name('show');

    });

    Route::get('/uploads/{path}', UploadsController::class)->where('path', '.*');
});
