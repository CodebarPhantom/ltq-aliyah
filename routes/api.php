<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\BackOffice\Base\BaseNotificationController;
use App\Http\Controllers\Api\V1\BackOffice\EntityController;
use App\Http\Controllers\Api\V1\PermissionGroupController;
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\BackOffice\MyActivity\MyLeaveController;
use App\Http\Controllers\Api\V1\BackOffice\MyActivity\MyPermitController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeeController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeeLeaveController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeePermitController;
use App\Http\Controllers\Api\V1\BackOffice\WorkSchedule\HolidayController;
use App\Http\Controllers\Api\V1\BackOffice\WorkSchedule\ShiftController;
use App\Http\Controllers\Api\V1\BackOffice\WorkSchedule\ShiftFixedController;
use App\Http\Controllers\Api\V1\BackOffice\WorkSchedule\ShiftRotatingController;
use App\Http\Controllers\Api\V1\BackOffice\Dashboard\DashboardController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\BackOffice\MyActivity\MyAttendanceController;
use App\Http\Controllers\Api\V1\BackOffice\MyActivity\MyBusinessTripController;
use App\Http\Controllers\Api\V1\BackOffice\MyActivity\MyOvertimeController;
use App\Http\Controllers\Api\V1\BackOffice\Report\ReportEmployeeAttendanceController;
use App\Http\Controllers\Api\V1\BackOffice\Report\ReportEmployeeShiftController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeeBusinessTripController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeeLoanController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeeOvertimeController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeePayrollCombenController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeePayrollController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeePayrollDeductionController;
use App\Http\Controllers\Api\V1\BackOffice\Workforce\EmployeeRoleRemunerationPackageController;
use App\Http\Controllers\Api\V1\BackOffice\WorkSchedule\ShiftAttendanceController;

// Route::post('/signin', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix("/api.")->as("api.")->group(function () {
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

            Route::prefix('/dashboard')->as('dashboard.')->group(function () {
                Route::get('/attendance-month', [DashboardController::class, 'attendanceMonth'])->name('attendance-month');
            });

            Route::prefix('/my-attendance')->as('my-attendance.')->group(function () {
                Route::post('/clock-in-out', [MyAttendanceController::class, 'attendance'])->name('attendance');

            });


            Route::prefix("/my-activity")->as("my-activity.")->group(function () {
                Route::prefix("/my-leave")->as("my-leave.")->group(function () {
                    Route::get('/datatable', [MyLeaveController::class, 'dataTable'])->name('datatable');
                });
                Route::prefix("/my-leave-confirm")->as("my-leave-confirm.")->group(function () {
                    Route::get('/datatable-confirmation', [MyLeaveController::class, 'dataTableConfirmLeave'])->name('datatable-confirm-leave');
                });

                Route::prefix("/my-permit")->as("my-permit.")->group(function () {
                    Route::get('/datatable', [MyPermitController::class, 'dataTable'])->name('datatable');
                });

                Route::prefix("/my-permit-confirm")->as("my-permit-confirm.")->group(function () {
                    Route::get('/datatable-confirmation', [MyPermitController::class, 'dataTableConfirmPermit'])->name('datatable-confirm-permit');
                });

                Route::prefix("/my-overtime")->as("my-overtime.")->group(function () {
                    Route::get('/datatable', [MyOvertimeController::class, 'dataTable'])->name('datatable');
                });
                Route::prefix("/my-overtime-confirm")->as("my-overtime-confirm.")->group(function () {
                    Route::get('/datatable-confirmation', [MyOvertimeController::class, 'dataTableConfirmOvertime'])->name('datatable-confirm-overtime');
                });

                Route::prefix("/my-business-trip")->as("my-business-trip.")->group(function () {
                    Route::get('/datatable', [MyBusinessTripController::class, 'dataTable'])->name('datatable');
                });

                Route::prefix("/my-business-trip-confirm")->as("my-business-trip-confirm.")->group(function () {
                    Route::get('/datatable-confirmation', [MyBusinessTripController::class, 'dataTableConfirmBusinessTrip'])->name('datatable-confirm-business-trip');
                });
            });

            Route::prefix("/work-schedule")->as("work-schedule.")->group(function () {
                Route::prefix("/holiday")->as("holiday.")->group(function () {

                    Route::get('/datatable', [HolidayController::class, 'dataTable'])->name('datatable');
                    Route::delete('/{holiday}', [HolidayController::class, 'destroy'])->name('destroy');
                });

                Route::prefix("/shift")->as("shift.")->group(function () {
                    Route::get('/datatable', [ShiftController::class, 'dataTable'])->name('datatable');
                    Route::delete('/{shift}', [ShiftController::class, 'destroy'])->name('destroy');
                });

                Route::prefix("/shift-fixed")->as("shift-fixed.")->group(function () {
                    Route::get('/datatable', [ShiftFixedController::class, 'dataTable'])->name('datatable');
                    Route::get('/shift-fixed-log-datatable/{shiftFixed}', [ShiftFixedController::class, 'shiftFixedLogsDataTable'])->name('shift-fixed-log-datatable');

                    Route::delete('/{shiftFixed}', [ShiftFixedController::class, 'destroy'])->name('destroy');
                    Route::delete('/shift-fixed-log/{shiftFixed}', [ShiftFixedController::class, 'shiftFixedLogDestroy'])->name('shift-fixed-log-destroy');

                });

                Route::prefix("/shift-rotating")->as("shift-rotating.")->group(function () {
                    Route::get('/datatable', [ShiftRotatingController::class, 'dataTable'])->name('datatable');
                    Route::post('/store', [ShiftRotatingController::class, 'store'])->name('store');
                    Route::delete('/{shiftRotating}', [ShiftRotatingController::class, 'destroy'])->name('destroy');
                });

                Route::prefix("/shift-attendance")->as("shift-attendance.")->group(function () {
                    Route::post('/bypass-attendance', [ShiftAttendanceController::class, 'bypassAttendance'])->name('bypass-attendance');
                });
            });

            Route::prefix("/report")->as("report.")->group(function(){
                Route::prefix("/employee")->as("employee.")->group(function(){
                    Route::get('report-attendance',[ReportEmployeeAttendanceController::class,'attendance'])->name('report-attendance');
                    Route::get('export-attendance',[ReportEmployeeAttendanceController::class,'exportAttendance'])->name('export-attendance');

                    Route::get('report-shift',[ReportEmployeeShiftController::class,'shift'])->name('report-shift');

                });
            });

            Route::prefix("/workforce")->as("workforce.")->group(function () {

                Route::prefix("/employee")->as("employee.")->group(function () {
                    Route::get('/datatable', [EmployeeController::class, 'dataTable'])->name('datatable');
                    Route::get('/get-all', [EmployeeController::class, 'getAllEmployees'])->name('get-all');
                    Route::get('/get-all-rotating-shift', [EmployeeController::class, 'getAllRotatingShiftEmployees'])->name('get-all-rotating-shift');

                    Route::post('/store', [EmployeeController::class, 'store'])->name('store');
                    Route::delete('/work-history/{id}', [EmployeeController::class, 'deleteWorkHistory'])->name('work-history.delete');
                    Route::delete('/education-history/{id}', [EmployeeController::class, 'deleteEducationHistory'])->name('education-history.delete');
                    Route::delete('/employee-agreement/{id}', [EmployeeController::class, 'deleteEmployeeAgreement'])->name('employee-agreement.delete');
                    Route::post('/upload-files', [EmployeeController::class, 'uploadFiles'])->name('files.upload');
                    Route::delete('/delete-file/{id}', [EmployeeController::class, 'deleteFile'])->name('files.delete');
                    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');
                });

                Route::prefix("/employee-payroll")->as("employee-payroll.")->group(function () {
                    Route::get('/datatable', [EmployeePayrollController::class, 'dataTable'])->name('datatable');
                });

                Route::prefix("/employee-payroll-comben")->as("employee-payroll-comben.")->group(function () {
                    Route::get('/datatable', [EmployeePayrollCombenController::class, 'dataTable'])->name('datatable');
                    Route::delete('/{comben}', [EmployeePayrollCombenController::class, 'destroy'])->name('destroy');
                });

                Route::prefix("/employee-payroll-deduction")->as("employee-payroll-deduction.")->group(function () {
                    Route::get('/datatable', [EmployeePayrollDeductionController::class, 'dataTable'])->name('datatable');
                    Route::delete('/{deduction}', [EmployeePayrollDeductionController::class, 'destroy'])->name('destroy');
                });

                Route::prefix("/employee-role-remuneration-package")->as("employee-role-remuneration-package.")->group(function(){
                    Route::get('/datatable',[EmployeeRoleRemunerationPackageController::class,'dataTable'])->name('datatable');
                    Route::delete('/{remuneration}', [EmployeeRoleRemunerationPackageController::class, 'deleteRemuneration'])->name('destroy');

                });

                Route::prefix("/employee-loan")->as("employee-loan.")->group(function(){
                    Route::get('/datatable',[EmployeeLoanController::class,'dataTable'])->name('datatable');
                    Route::delete('/{loan}', [EmployeeLoanController::class, 'destroy'])->name('destroy');
                });

                Route::prefix("/submitted-form")->as("submitted-form.")->group(function () {
                    Route::prefix("/leave")->as("leave.")->group(function () {
                        Route::get('/datatable', [EmployeeLeaveController::class, 'dataTable'])->name('dataTable');
                    });

                    Route::prefix("/permit")->as("permit.")->group(function () {
                        Route::get('/datatable', [EmployeePermitController::class, 'dataTable'])->name('dataTable');
                    });

                    Route::prefix("/business-trip")->as("business-trip.")->group(function () {
                        Route::get('/datatable', [EmployeeBusinessTripController::class, 'dataTable'])->name('dataTable');
                    });

                    Route::prefix("/overtime")->as("overtime.")->group(function () {
                        Route::get('/datatable', [EmployeeOvertimeController::class, 'dataTable'])->name('dataTable');
                    });
                });
            });
            // Entity Routes
            Route::prefix('/entity')->as('entity.')->group(function () {
                Route::get('/datatable', [EntityController::class, 'dataTable'])->name('datatable');
                Route::delete('/{entity}', [EntityController::class, 'destroy'])->name('destroy');
            });

            // Company Routes
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
        });
    });
});
