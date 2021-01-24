<?php
use App\Http\Controllers\Admin\HouseKipping\HouseKippingController;
use App\Http\Controllers\Admin\HouseKipping\HousekeepingReportController;
// housekipping manage controller
Route::middleware(['admin'])->prefix(md5('admin/house/keeping'))->group(function () {
    Route::get('/', [HouseKippingController::class, 'index'])->name('admin.housekipping.home');
    Route::get('/report', [HouseKippingController::class, 'reportList'])->name('admin.housekipping.report.list');
    Route::post('/update', [HouseKippingController::class, 'reportUpdate'])->name('admin.housekepping.update');
});

Route::middleware(['admin'])->prefix(md5('admin/house/keeping/report'))->group(function () {
    Route::get('/', [HousekeepingReportController::class, 'cleaningDuration'])->name('admin.housekipping.clean.duration.report');
    Route::get('/day/wise', [HousekeepingReportController::class, 'dayWiseHousekeeping'])->name('admin.housekipping.day.wise.report');
    Route::get('/room/wise', [HousekeepingReportController::class, 'roomWiseHousekeeping'])->name('admin.housekipping.room.wise.report');
    Route::get('/employee/wise', [HousekeepingReportController::class, 'employeeWiseHousekeeping'])->name('admin.housekipping.employee.wise.report');
});


// Ajax route start from here
Route::get('/admin/housekepping/ajax/list/{id}', [HouseKippingController::class, 'reporAjaxList']);
Route::get('/admin/housekepping/clean/duration/ajax/list', [HousekeepingReportController::class, 'cleaningDurationGetAjaxData']);
Route::get('/admin/housekepping/clean/day/wise/ajax/list', [HousekeepingReportController::class, 'cleaningDayWiseGetAjaxData']);
Route::get('/admin/housekepping/room/wise/ajax/list', [HousekeepingReportController::class, 'roomWiseGetAjaxData']);
Route::get('/admin/housekepping/employee/wise/ajax/list', [HousekeepingReportController::class, 'employeeWiseGetAjaxData']);
