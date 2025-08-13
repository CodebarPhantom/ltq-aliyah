<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Workforce\EmployeeController;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\EntityController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\DivisionController;
use App\Http\Controllers\Web\DepartementController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\PermissionGroupController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\UploadsController;
use App\Http\Controllers\Web\FormEntryController;
use App\Http\Controllers\Web\MyActivity\MyAttendanceController;
use App\Http\Controllers\Web\MyActivity\MyBusinessTripController;
use App\Http\Controllers\Web\MyActivity\MyLeaveController;
use App\Http\Controllers\Web\MyActivity\MyOvertimeController;
use App\Http\Controllers\Web\MyActivity\MyPermitController;
use App\Http\Controllers\Web\Report\ReportEmployeeAttendanceController;
use App\Http\Controllers\Web\Report\ReportEmployeeShiftController;
use App\Http\Controllers\Web\User\UserController;
use App\Http\Controllers\Web\Workforce\EmployeeBusinessTripController;
use App\Http\Controllers\Web\Workforce\EmployeeLeaveController;
use App\Http\Controllers\Web\Workforce\EmployeeLoanController;
use App\Http\Controllers\Web\Workforce\EmployeeOvertimeController;
use App\Http\Controllers\Web\Workforce\EmployeePayrollCombenController;
use App\Http\Controllers\Web\Workforce\EmployeePayrollController;
use App\Http\Controllers\Web\Workforce\EmployeePayrollDeductionController;
use App\Http\Controllers\Web\Workforce\EmployeePermitController;
use App\Http\Controllers\Web\Workforce\EmployeeRoleRemunerationPackageController;
use App\Http\Controllers\Web\WorkSchedule\HolidayController;
use App\Http\Controllers\Web\WorkSchedule\ShiftController;
use App\Http\Controllers\Web\WorkSchedule\ShiftFixedController;
use App\Http\Controllers\Web\WorkSchedule\ShiftRotatingController;

Route::middleware(['auth'/*, 'verified'*/])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix("/my-activity")->as("my-activity.")->group(function () {
        Route::prefix("/my-leave")->as("my-leave.")->group(function () {
            Route::get('', [MyLeaveController::class, 'index'])->name('index');
            Route::get('/create', [MyLeaveController::class, 'create'])->name('create');
            Route::post('/', [MyLeaveController::class, 'store'])->name('store');
            Route::get('/{leave}', [MyLeaveController::class, 'show'])->name('show');
            Route::put('/{leave}/cancel-leave', [MyLeaveController::class, 'cancelLeaveUpdate'])->name('cancel-leave-update');
        });

        Route::prefix("/my-leave-confirm")->as("my-leave-confirm.")->group(function () {
            Route::get('/confirm-leave', [MyLeaveController::class, 'confirmLeaveIndex'])->name('confirm-leave-index');
            Route::get('/{leave}/confirm-leave-show', [MyLeaveController::class, 'confirmLeaveShow'])->name('confirm-leave-show');
            Route::put('/{leave}/confirm-leave', [MyLeaveController::class, 'confirmLeaveUpdate'])->name('confirm-leave-update');
            Route::put('/{leave}/reject-leave', [MyLeaveController::class, 'rejectLeaveUpdate'])->name('reject-leave-update');
        });

        Route::prefix("/my-permit")->as("my-permit.")->group(function () {
            Route::get('', [MyPermitController::class, 'index'])->name('index');
            Route::get('/create', [MyPermitController::class, 'create'])->name('create');
            Route::post('/', [MyPermitController::class, 'store'])->name('store');
            Route::get('/{permit}', [MyPermitController::class, 'show'])->name('show');
            Route::put('/{permit}/cancel-permit', [MyPermitController::class, 'cancelPermitUpdate'])->name('cancel-permit-update');
        });

        Route::prefix("/my-permit-confirm")->as("my-permit-confirm.")->group(function () {
            Route::get('/confirm-permit', [MyPermitController::class, 'confirmPermitIndex'])->name('confirm-permit-index');
            Route::get('/{permit}/confirm-permit-show', [MyPermitController::class, 'confirmPermitShow'])->name('confirm-permit-show');
            Route::put('/{permit}/confirm-permit', [MyPermitController::class, 'confirmPermitUpdate'])->name('confirm-permit-update');
            Route::put('/{permit}/reject-permit', [MyPermitController::class, 'rejectPermitUpdate'])->name('reject-permit-update');
        });

        Route::prefix("/my-business-trip")->as("my-business-trip.")->group(function () {
            Route::get('', [MyBusinessTripController::class, 'index'])->name('index');
            Route::get('/create', [MyBusinessTripController::class, 'create'])->name('create');
            Route::post('/', [MyBusinessTripController::class, 'store'])->name('store');
            Route::get('/{businessTrip}', [MyBusinessTripController::class, 'show'])->name('show');
            Route::put('/{businessTrip}/cancel-business-trip', [MyBusinessTripController::class, 'cancelBusinessTripUpdate'])->name('cancel-business-trip-update');
        });

        Route::prefix("/my-business-trip-confirm")->as("my-business-trip-confirm.")->group(function () {
            Route::get('/confirm-business-trip', [MyBusinessTripController::class, 'confirmBusinessTripIndex'])->name('confirm-business-trip-index');
            Route::get('/{businessTrip}/confirm-business-trip-show', [MyBusinessTripController::class, 'confirmBusinessTripShow'])->name('confirm-business-trip-show');
            Route::put('/{businessTrip}/confirm-business-trip', [MyBusinessTripController::class, 'confirmBusinessTripUpdate'])->name('confirm-business-trip-update');
            Route::put('/{businessTrip}/reject-business-trip', [MyBusinessTripController::class, 'rejectBusinessTripUpdate'])->name('reject-business-trip-update');
        });


        Route::prefix("/my-overtime")->as("my-overtime.")->group(function () {
            Route::get('', [MyOvertimeController::class, 'index'])->name('index');
            Route::get('/create', [MyOvertimeController::class, 'create'])->name('create');
            Route::post('/', [MyOvertimeController::class, 'store'])->name('store');
            Route::get('/{overtime}', [MyOvertimeController::class, 'show'])->name('show');
            Route::put('/{overtime}/cancel-overtime', [MyOvertimeController::class, 'cancelOvertimeUpdate'])->name('cancel-overtime-update');
        });

        Route::prefix("/my-overtime-confirm")->as("my-overtime-confirm.")->group(function () {
            Route::get('/confirm-overtime', [MyOvertimeController::class, 'confirmOvertimeIndex'])->name('confirm-overtime-index');
            Route::get('/{overtime}/confirm-overtime-show', [MyOvertimeController::class, 'confirmOvertimeShow'])->name('confirm-overtime-show');
            Route::put('/{overtime}/confirm-overtime', [MyOvertimeController::class, 'confirmOvertimeUpdate'])->name('confirm-overtime-update');
            Route::put('/{overtime}/reject-overtime', [MyOvertimeController::class, 'rejectOvertimeUpdate'])->name('reject-overtime-update');
        });

        Route::prefix("/my-attendance")->as("my-attendance.")->group(function () {
            Route::get('', [MyAttendanceController::class, 'index'])->name('index');
        });
    });

    Route::prefix("/workforce")->as("workforce.")->group(function () {

        Route::prefix("/employee")->as("employee.")->group(function () {
            Route::get('', [EmployeeController::class, 'index'])->name('index');
            Route::get('/create', [EmployeeController::class, 'create'])->name('create');
            Route::post('/', [EmployeeController::class, 'store'])->name('store');
            Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
            Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
            Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
            Route::get('/{employee}/user', [EmployeeController::class, 'editUser'])->name('edit.user');
            Route::put('/{employee}/user', [EmployeeController::class, 'updateUser'])->name('update.user');
        });

        Route::prefix("/employee-payroll")->as("employee-payroll.")->group(function () {
            Route::get('', [EmployeePayrollController::class, 'index'])->name('index');
            Route::get('/{employeePayrollId}', [EmployeePayrollController::class, 'show'])->name('show');

            Route::post('/generate-payroll', [EmployeePayrollController::class, 'generate'])->name('generate');
        });

        Route::prefix("/employee-payroll-comben")->as("employee-payroll-comben.")->group(function () {
            Route::get('', [EmployeePayrollCombenController::class, 'index'])->name('index');
            Route::get('/create', [EmployeePayrollCombenController::class, 'create'])->name('create');
            Route::post('/', [EmployeePayrollCombenController::class, 'store'])->name('store');
            Route::get('/{comben}', [EmployeePayrollCombenController::class, 'show'])->name('show');
            Route::get('/{comben}/edit', [EmployeePayrollCombenController::class, 'edit'])->name('edit');
            Route::put('/{comben}', [EmployeePayrollCombenController::class, 'update'])->name('update');
        });

        Route::prefix("/employee-payroll-deduction")->as("employee-payroll-deduction.")->group(function () {
            Route::get('', [EmployeePayrollDeductionController::class, 'index'])->name('index');
            Route::get('/create', [EmployeePayrollDeductionController::class, 'create'])->name('create');
            Route::post('/', [EmployeePayrollDeductionController::class, 'store'])->name('store');
            Route::get('/{deduction}', [EmployeePayrollDeductionController::class, 'show'])->name('show');
            Route::get('/{deduction}/edit', [EmployeePayrollDeductionController::class, 'edit'])->name('edit');
            Route::put('/{deduction}', [EmployeePayrollDeductionController::class, 'update'])->name('update');
        });

        Route::prefix("/employee-role-remuneration-package")->as("employee-role-remuneration-package.")->group(function () {
            Route::get('', [EmployeeRoleRemunerationPackageController::class, 'index'])->name('index');
            Route::get('/{roleId}/edit', [EmployeeRoleRemunerationPackageController::class, 'edit'])->name('edit');
            Route::get('/{role}', [EmployeeRoleRemunerationPackageController::class, 'show'])->name('show');
            Route::put('/{roleId}', [EmployeeRoleRemunerationPackageController::class, 'update'])->name('update');
        });

        Route::prefix("/submitted-form")->as("submitted-form.")->group(function () {

            Route::prefix("/leave")->as("leave.")->group(function () {
                Route::get('', [EmployeeLeaveController::class, 'index'])->name('index');
                Route::get('/create', [EmployeeLeaveController::class, 'create'])->name('create');
                Route::post('/', [EmployeeLeaveController::class, 'store'])->name('store');
                Route::get('/{leave}', [EmployeeLeaveController::class, 'show'])->name('show');
                Route::get('/{leave}/edit', [EmployeeLeaveController::class, 'edit'])->name('edit');
                Route::put('/{leave}', [EmployeeLeaveController::class, 'update'])->name('update');
                Route::put('/{leave}/confirm-leave', [EmployeeLeaveController::class, 'confirmLeaveUpdate'])->name('confirm-leave-update');
                Route::put('/{leave}/reject-leave', [EmployeeLeaveController::class, 'rejectLeaveUpdate'])->name('reject-leave-update');
            });

            Route::prefix("/permit")->as("permit.")->group(function () {
                Route::get('', [EmployeePermitController::class, 'index'])->name('index');
                Route::get('/create', [EmployeePermitController::class, 'create'])->name('create');
                Route::post('/', [EmployeePermitController::class, 'store'])->name('store');
                Route::get('/{permit}', [EmployeePermitController::class, 'show'])->name('show');
                Route::get('/{permit}/edit', [EmployeePermitController::class, 'edit'])->name('edit');
                Route::put('/{permit}', [EmployeePermitController::class, 'update'])->name('update');
                Route::put('/{permit}/confirm-permit', [EmployeePermitController::class, 'confirmPermitUpdate'])->name('confirm-permit-update');
                Route::put('/{permit}/confirm-permit-unpaid-leave', [EmployeePermitController::class, 'confirmPermitUpdateUnpaidLeave'])->name('confirm-permit-update-unpaid-leave');
                Route::put('/{permit}/reject-permit', [EmployeePermitController::class, 'rejectPermitUpdate'])->name('reject-permit-update');
            });

            Route::prefix("/business-trip")->as("business-trip.")->group(function () {
                Route::get('', [EmployeeBusinessTripController::class, 'index'])->name('index');
                Route::get('/create', [EmployeeBusinessTripController::class, 'create'])->name('create');
                Route::post('/', [EmployeeBusinessTripController::class, 'store'])->name('store');
                Route::get('/{businessTrip}', [EmployeeBusinessTripController::class, 'show'])->name('show');
                Route::get('/{businessTrip}/edit', [EmployeeBusinessTripController::class, 'edit'])->name('edit');
                Route::put('/{businessTrip}', [EmployeeBusinessTripController::class, 'update'])->name('update');
                Route::put('/{businessTrip}/confirm-business-trip', [EmployeeBusinessTripController::class, 'confirmBusinessTripUpdate'])->name('confirm-business-trip-update');
                Route::put('/{businessTrip}/reject-business-trip', [EmployeeBusinessTripController::class, 'rejectBusinessTripUpdate'])->name('reject-business-trip-update');
            });

            Route::prefix("/overtime")->as("overtime.")->group(function () {
                Route::get('', [EmployeeOvertimeController::class, 'index'])->name('index');
                Route::get('/create', [EmployeeOvertimeController::class, 'create'])->name('create');
                Route::post('/', [EmployeeOvertimeController::class, 'store'])->name('store');
                Route::get('/{overtime}', [EmployeeOvertimeController::class, 'show'])->name('show');
                Route::get('/{overtime}/edit', [EmployeeOvertimeController::class, 'edit'])->name('edit');
                Route::put('/{overtime}', [EmployeeOvertimeController::class, 'update'])->name('update');
                Route::put('/{overtime}/confirm-overtime', [EmployeeOvertimeController::class, 'confirmOvertimeUpdate'])->name('confirm-overtime-update');
                Route::put('/{overtime}/reject-overtime', [EmployeeOvertimeController::class, 'rejectOvertimeUpdate'])->name('reject-overtime-update');
            });
        });

        Route::prefix("/employee-loan")->as("employee-loan.")->group(function () {
            Route::get('', [EmployeeLoanController::class, 'index'])->name('index');
            Route::get('/create', [EmployeeLoanController::class, 'create'])->name('create');
            Route::post('/', [EmployeeLoanController::class, 'store'])->name('store');
            Route::get('/{loan}', [EmployeeLoanController::class, 'show'])->name('show');
            Route::get('/{loan}/edit', [EmployeeLoanController::class, 'edit'])->name('edit');
            Route::put('/{loan}', [EmployeeLoanController::class, 'update'])->name('update');
            Route::put('/{loan}/accelerated-repayment', [EmployeeLoanController::class, 'acceleratedRepayment'])->name('accelerated-repayment');
        });
    });

    Route::prefix("/work-schedule")->as("work-schedule.")->group(function () {

        Route::prefix("/holiday")->as("holiday.")->group(function () {
            Route::get('', [HolidayController::class, 'index'])->name('index');
            Route::get('/create', [HolidayController::class, 'create'])->name('create');
            Route::post('/', [HolidayController::class, 'store'])->name('store');
            Route::get('/{holiday}', [HolidayController::class, 'show'])->name('show');
            Route::get('/{holiday}/edit', [HolidayController::class, 'edit'])->name('edit');
            Route::put('/{holiday}', [HolidayController::class, 'update'])->name('update');
        });

        Route::prefix("/shift")->as("shift.")->group(function () {
            Route::get('', [ShiftController::class, 'index'])->name('index');
            Route::get('/create', [ShiftController::class, 'create'])->name('create');
            Route::post('/', [ShiftController::class, 'store'])->name('store');
            Route::get('/{shift}', [ShiftController::class, 'show'])->name('show');
            Route::get('/{shift}/edit', [ShiftController::class, 'edit'])->name('edit');
            Route::put('/{shift}', [ShiftController::class, 'update'])->name('update');
        });

        Route::prefix("/shift-fixed")->as("shift-fixed.")->group(function () {
            Route::get('', [ShiftFixedController::class, 'index'])->name('index');
            Route::get('/create', [ShiftFixedController::class, 'create'])->name('create');
            Route::post('/', [ShiftFixedController::class, 'store'])->name('store');
            Route::get('/{shiftFixed}', [ShiftFixedController::class, 'show'])->name('show');
            Route::get('/{shiftFixed}/edit', [ShiftFixedController::class, 'edit'])->name('edit');
            Route::put('/{shiftFixed}', [ShiftFixedController::class, 'update'])->name('update');
        });

        Route::prefix("/shift-rotating")->as("shift-rotating.")->group(function () {
            Route::get('', [ShiftRotatingController::class, 'index'])->name('index');
            Route::get('/create', [ShiftRotatingController::class, 'create'])->name('create');
            Route::post('/', [ShiftRotatingController::class, 'store'])->name('store');
            Route::get('/{shiftRotating}', [ShiftRotatingController::class, 'show'])->name('show');
            Route::get('/{shiftRotating}/edit', [ShiftRotatingController::class, 'edit'])->name('edit');
            Route::put('/{shiftRotating}', [ShiftRotatingController::class, 'update'])->name('update');
        });
    });

    Route::prefix("/report")->as("report.")->group(function () {
        Route::prefix("/employee")->as("employee.")->group(function () {
            Route::get('attendance', [ReportEmployeeAttendanceController::class, 'attendance'])->name('attendance');
            Route::get('shift', [ReportEmployeeShiftController::class, 'shift'])->name('shift');
        });
    });
    //Route::prefix("/config")->as("config.")->group(function(){

    Route::prefix("/entity")->as("entity.")->group(function () {
        Route::get('', [EntityController::class, 'index'])->name('index');
        Route::get('/create', [EntityController::class, 'create'])->name('create');
        Route::post('/', [EntityController::class, 'store'])->name('store');
        Route::get('/{entity}', [EntityController::class, 'show'])->name('show');
        Route::get('/{entity}/edit', [EntityController::class, 'edit'])->name('edit');
        Route::put('/{entity}', [EntityController::class, 'update'])->name('update');
    });

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

        // Alias khusus untuk form tertentu
        Route::get('/rekapitulasi-kesalahan-bacaan/create', [FormEntryController::class, 'create'])
            ->defaults('formCode', 'rekapitulasi-kesalahan-bacaan')
            ->name('create.rekapitulasi-kesalahan-bacaan');
    });


    Route::get('/uploads/{path}', UploadsController::class)->where('path', '.*');
});
