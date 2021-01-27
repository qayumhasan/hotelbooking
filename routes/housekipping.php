<?php
use App\Http\Controllers\Admin\HouseKipping\HouseKippingController;
use App\Http\Controllers\Admin\HouseKipping\HousekeepingReportController;
use App\Http\Controllers\Admin\HouseKipping\HousekeepingGuestEntryController;
use App\Http\Controllers\Admin\HouseKipping\ItemEntryController;
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
    Route::get('/employee/wise', [HousekeepingReportController::class, 'employeeWiseHousekeeping'])->name('admin.housekipping.employee.wise.report');
});

Route::middleware(['admin'])->prefix(md5('admin/house/person/entry'))->group(function () {
    Route::get('/', [HousekeepingGuestEntryController::class, 'guestEntryPage'])->name('admin.housekipping.person.entry');
    Route::get('/report', [HousekeepingGuestEntryController::class, 'guestEntryReportPage'])->name('admin.housekipping.person.entry.report');
    Route::get('/cross/check', [HousekeepingGuestEntryController::class, 'guestEntryCrossCheck'])->name('admin.housekipping.person.entry.cross.check');
   
});

Route::middleware(['admin'])->prefix(md5('admin/housekeeping/distribution/items'))->group(function () {
    Route::get('/room/issue', [ItemEntryController::class, 'issueToRoom'])->name('admin.housekeeping.distribution.items.issue.room');   
    Route::post('/items/store', [ItemEntryController::class, 'itemStore'])->name('admin.housekeeping.item.store');   
    Route::get('/items/store/list', [ItemEntryController::class, 'itemStoreList'])->name('admin.housekeeping.distribution.items.issue.list');   
    Route::get('/items/store/list/edit/{id}', [ItemEntryController::class, 'itemStoreListEdit'])->name('admin.housekeeping.distribution.items.issue.list.edit');   
    Route::post('/items/store/list/update', [ItemEntryController::class, 'itemStoreListUpdate'])->name('admin.housekeeping.item.update');   
    Route::post('/items/store/ajax/list', [ItemEntryController::class, 'itemStoreAjaxList'])->name('admin.housekeeping.distribution.items.issue.ajax.list');   
});

Route::middleware(['admin'])->prefix(md5('admin/housekeeping/room/wise/items'))->group(function () {
    Route::get('/list', [ItemEntryController::class, 'issueToRoomWiseList'])->name('admin.housekeeping.distribution.items.issue.room.list');   
   
});


// Ajax route start from here
Route::get('/admin/housekepping/ajax/list/{id}', [HouseKippingController::class, 'reporAjaxList']);
Route::get('/admin/housekepping/clean/duration/ajax/list', [HousekeepingReportController::class, 'cleaningDurationGetAjaxData']);
Route::get('/admin/housekepping/clean/day/wise/ajax/list', [HousekeepingReportController::class, 'cleaningDayWiseGetAjaxData']);
Route::get('/admin/housekepping/room/wise/ajax/list', [HousekeepingReportController::class, 'roomWiseGetAjaxData']);
Route::get('/admin/housekepping/employee/wise/ajax/list', [HousekeepingReportController::class, 'employeeWiseGetAjaxData']);
Route::get('/admin/housekeeping/guest/entry/pax/store', [HousekeepingGuestEntryController::class, 'getEntrypaxStore']);
Route::get('/admin/housekepping/guest/entry/report/ajax/list', [HousekeepingGuestEntryController::class, 'guestEntryReportAjaxData']);
Route::get('/admin/housekepping/guest/entry/report/check/ajax/list', [HousekeepingGuestEntryController::class, 'guestEntryReportCheckAjaxData']);
