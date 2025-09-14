<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\PermissionGroupController;
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\FormEntryController;
use App\Http\Controllers\Api\V1\SummaryController;

// Route::post('/signin', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix("/api")->as("api.")->group(function () {
    Route::prefix("/v1")->as("v1.")->group(function () {

        Route::prefix("/auth")->as("auth.")->group(function () {
            Route::post('/signin', [AuthController::class, 'login']);
        });

        // Route::prefix("/user")->as("user.")->group(function () {
        //     Route::middleware(['auth:sanctum', 'ability:users-create'])->post('', [UserController::class, 'create']);
        // });

        Route::get('/server-time', function () {
            return response()->json([
                'time' => now()->format('H:i:s'),
            ]);
        })->name('server-time');

        Route::middleware(['auth:sanctum'])->group(function () {

            Route::post('/notifications/mark-all-read', [BaseNotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

            Route::prefix('/location')->as('location.')->group(function () {
                Route::get('/datatable', [LocationController::class, 'dataTable'])->name('datatable');
                Route::delete('/{location}', [LocationController::class, 'destroy'])->name('destroy');
            });


            Route::prefix('/permission-groups')->as('permission-groups.')->group(function () {
                Route::get('/datatable', [PermissionGroupController::class, 'dataTable'])->name('datatable');
                Route::delete('/{permissionGroups}', [PermissionGroupController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('/permissions')->as('permissions.')->group(function () {
                Route::get('/datatable', [PermissionController::class, 'dataTable'])->name('datatable');
            });

            Route::prefix('/roles')->as('roles.')->group(function () {
                Route::get('/datatable', [RoleController::class, 'dataTable'])->name('datatable');
                Route::get('/get-all-role', [RoleController::class, 'getAllRole'])->name('get-all-role');
            });

            Route::prefix('/users')->as('users.')->group(function () {
                Route::get('/datatable', [UserController::class, 'dataTable'])->name('datatable');
            });

            Route::prefix("/forms")->as("forms.")->group(function () {
                Route::post('/{formCode}/store', [FormEntryController::class, 'store'])
                    ->name('store');

                Route::get('/rekapitulasi-kesalahan-bacaan/store', [FormEntryController::class, 'store'])
                    ->defaults('formCode', 'rekapitulasi-kesalahan-bacaan')
                    ->name('store.rekapitulasi-kesalahan-bacaan');
            });

            Route::prefix('/summaries')->as('summaries.')->group(function () {
                Route::get('/datatable', [SummaryController::class, 'dataTable'])->name('datatable');
            });
        });
    });
});
