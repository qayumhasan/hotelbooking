<?php
use App\Http\Controllers\Admin\HouseKipping\HouseKippingController;
use App\Http\Controllers\Admin\HouseKipping\HousekeepingReportController;
use App\Http\Controllers\Admin\HouseKipping\HousekeepingGuestEntryController;
use App\Http\Controllers\Admin\HouseKipping\ItemEntryController;
use App\Http\Controllers\Admin\HouseKipping\MaintenanceDistributionController;
use App\Http\Controllers\Admin\HouseKipping\AcquisitionController;
use App\Http\Controllers\Admin\HouseKipping\OccupancyController;
use App\Http\Controllers\Admin\HouseKipping\AdvanceBookingHouseKeepingController;
use App\Http\Controllers\Admin\HouseKipping\OccupancyReportController;
// housekipping manage controller
Route::middleware(['admin'])->prefix(md5('admin/house/keeping'))->group(function () {
    Route::get('/', [HouseKippingController::class, 'index'])->name('admin.housekipping.home');
    Route::get('/report', [HouseKippingController::class, 'reportList'])->name('admin.housekipping.report.list');
    Route::post('/update', [HouseKippingController::class, 'reportUpdate'])->name('admin.housekepping.update');
    Route::get('/history/{id}', [HouseKippingController::class, 'getHousekeepingHistory'])->name('admin.housekeeping.history');
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
    Route::post('/ajax/list', [ItemEntryController::class, 'issueToRoomWiseAjaxList'])->name('admin.housekeeping.distribution.items.issue.room.ajax.list');   
   
});

Route::middleware(['admin'])->prefix(md5('admin/housekeeping/date/wise/items'))->group(function () {
    Route::get('/list', [ItemEntryController::class, 'issueToDateWiseList'])->name('admin.housekeeping.distribution.items.issue.date.list');   
    Route::post('/ajax/list', [ItemEntryController::class, 'issueToRoomWiseAjaxList'])->name('admin.housekeeping.distribution.items.issue.room.ajax.list');   
    Route::post('/list', [ItemEntryController::class, 'issueToDateWiseAjaxList'])->name('admin.housekeeping.distribution.items.issue.date.ajax.list');   
   
});


Route::middleware(['admin'])->prefix(md5('admin/housekeeping/maintenance/distribution/items'))->group(function () {

    Route::get('/issue', [MaintenanceDistributionController::class, 'issueDepartmentWiseDistribution'])->name('admin.housekeeping.maintenance.distribution.items.issue');    
    Route::post('/store', [MaintenanceDistributionController::class, 'issueDepartmentWiseDistributionStore'])->name('admin.housekeeping.department.item.store');  
    
    Route::get('/list', [MaintenanceDistributionController::class, 'issueDepartmentWiseDistributionList'])->name('admin.housekeeping.maintenance.distribution.items.issue.list'); 

    Route::get('/edit/{id}', [MaintenanceDistributionController::class, 'issueDepartmentWiseDistributionedit'])->name('admin.housekeeping.maintenance.distribution.items.issue.edit');  
    Route::post('/update', [MaintenanceDistributionController::class, 'issueDepartmentWiseDistributionUpdate'])->name('admin.housekeeping.maintenance.distribution.items.issue.update');  
    
    Route::get('/department/list', [MaintenanceDistributionController::class, 'departmentWiseDistributionlist'])->name('admin.housekeeping.maintenance.distribution.items.department.list');  

    Route::post('/department/ajax/list', [MaintenanceDistributionController::class, 'departmentWiseDistributionAjaxlist'])->name('admin.housekeeping.maintenance.distribution.items.issue.ajax.list');  

    Route::post('/department/wise/ajax/list', [MaintenanceDistributionController::class, 'departmentwiseDistrubutionAjaxList'])->name('admin.housekeeping.maintenance.distribution.items.department.wise.ajax.list');  

    Route::get('/date/wise/list', [MaintenanceDistributionController::class, 'dateWiseDistributionlist'])->name('admin.housekeeping.maintenance.distribution.date.wise.list'); 

    Route::post('/list', [MaintenanceDistributionController::class, 'issueToDateWiseAjaxList'])->name('admin.housekeeping.distribution.items.issue.date.wise.ajax.list'); 
});

// occupancy report area start

Route::middleware(['admin'])->prefix(md5('admin/housekeeping/occupancey'))->group(function () {
    Route::get('/report', [OccupancyController::class, 'inhouseGuestReport'])->name('admin.housekeeping.occupancey.report');
    Route::get('/expected/checkout/report', [OccupancyController::class, 'expCheckoutReport'])->name('admin.housekeeping.expected.checkout.report');
});




Route::middleware(['admin'])->prefix('admin/housekeeping/advance/report')->group(function () {
    Route::get('/', [AdvanceBookingHouseKeepingController::class, 'showAdvanceBookingReportPage'])->name('admin.housekeeping.advance.booking.report.list');

    
    Route::get('/edit/{id}', [AdvanceBookingHouseKeepingController::class, 'showAdvanceBookingReportEdit'])->name('admin.housekeeping.advance.booking.report.edit');
    Route::post('/update/{id}', [AdvanceBookingHouseKeepingController::class, 'showAdvanceBookingReportUpdate'])->name('admin.housekeeping.advance.booking.update');
    Route::get('/delete/{id}', [AdvanceBookingHouseKeepingController::class, 'deleteAdvanceBookingReport'])->name('admin.housekeeping.advance.booking.delete');
    Route::get('/status/{id}', [AdvanceBookingHouseKeepingController::class, 'statusAdvanceBookingReport'])->name('admin.housekeeping.advance.booking.status');

    
    Route::get('/calender', [AdvanceBookingHouseKeepingController::class, 'advanceBookingCalender'])->name('admin.housekeeping.advance.booking.calender');
    Route::get('/get', [AdvanceBookingHouseKeepingController::class, 'getadvanceBookingReport']);
    Route::get('/daybyday', [AdvanceBookingHouseKeepingController::class, 'getadvanceBookingReportDayByDay']);
    Route::get('/get/room/{id}', [AdvanceBookingHouseKeepingController::class, 'advanceBookingRoom'])->name('admin.housekeeping.advance.booking.room');
    Route::get('/day/by/day', [AdvanceBookingHouseKeepingController::class, 'advanceBookingCalenderDaybyDay'])->name('admin.housekeeping.advance.booking.calender.daybyday');
});

Route::middleware(['admin'])->prefix('admin/housekeeping/advance/')->group(function () {
    Route::get('/occupancy/report', [OccupancyReportController::class, 'occupancyReport'])->name('admin.housekeeping.expected.occupancy.report');
    Route::get('/occupancy/report/icon', [OccupancyReportController::class, 'occupancyReportIcon'])->name('admin.housekeeping.expected.occupancy.report.icon');
});





// Order Acquisition area start from here

Route::get(md5('admin/acquisition/create'), [AcquisitionController::class, 'create'])->name('admin.acquisition.create');
Route::get(md5('admin/acquisition/index'), [AcquisitionController::class, 'index'])->name('admin.acquisition.index');
Route::get('/get/item/all/{item_name}', [AcquisitionController::class, 'getitem']);
Route::post('/get/item/show/{invoice}', [AcquisitionController::class, 'allrecuitem'])->name('get.item.show');
Route::post('/get/item/delete/', [AcquisitionController::class, 'itemdelete'])->name('get.item.delete');
Route::get('/get/item/insert/', [AcquisitionController::class, 'iteminsert'])->name('item.insert.data');
Route::post('/get/item/order/submit/', [AcquisitionController::class, 'ordersubmit'])->name('orderhead.submit');
Route::post('/get/oderrecusition/edit/', [AcquisitionController::class, 'orderedit'])->name('get.item.edit');
Route::get('admin/acquisition/edit/{id}', [AcquisitionController::class, 'edit']);
Route::post('admin/acquisition/update/', [AcquisitionController::class, 'orderupdate'])->name('orderhead.update');
Route::get('admin/acquisition/delete/{id}', [AcquisitionController::class, 'orderdelete']);
Route::get('admin/acquisition/deactive/{id}', [AcquisitionController::class, 'acquistionStatus']);

Route::get('admin/acquisition/pending/order', [AcquisitionController::class, 'pendingOrderList'])->name('admin.acquisiton.pending.order.list');
Route::get('admin/acquisition/close/order', [AcquisitionController::class, 'closeOrderList'])->name('admin.acquisiton.close.order.list');


// Ajax route start from here
Route::get('/admin/housekepping/ajax/list/{id}', [HouseKippingController::class, 'reporAjaxList']);

Route::get('/admin/housekepping/clean/duration/ajax/list', [HousekeepingReportController::class, 'cleaningDurationGetAjaxData']);
Route::get('/admin/housekepping/clean/day/wise/ajax/list', [HousekeepingReportController::class, 'cleaningDayWiseGetAjaxData']);
Route::get('/admin/housekepping/room/wise/ajax/list', [HousekeepingReportController::class, 'roomWiseGetAjaxData']);
Route::get('/admin/housekepping/employee/wise/ajax/list', [HousekeepingReportController::class, 'employeeWiseGetAjaxData']);
Route::get('/admin/housekeeping/guest/entry/pax/store', [HousekeepingGuestEntryController::class, 'getEntrypaxStore']);
Route::get('/admin/housekepping/guest/entry/report/ajax/list', [HousekeepingGuestEntryController::class, 'guestEntryReportAjaxData']);
Route::get('/admin/housekepping/guest/entry/report/check/ajax/list', [HousekeepingGuestEntryController::class, 'guestEntryReportCheckAjaxData']);
Route::get('admin/get/item/section/{id}', [ItemEntryController::class, 'getItemSection']);
Route::get('admin/housekepping/occupancy/exp/report/ajax/list', [OccupancyController::class, 'expCheckoutReportAjaxData']);
Route::post('admin/house/keeping/search/{id}', [HouseKippingController::class, 'houseKeepingSearch']);



