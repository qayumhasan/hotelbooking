<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\BulkSmsController;
use App\Http\Controllers\Admin\Hotel\HotelManageController;
use App\Http\Controllers\Admin\Hotel\BranchController;
use App\Http\Controllers\Admin\Hotel\FloorController;
use App\Http\Controllers\Admin\Hotel\RoomTypeController;
use App\Http\Controllers\Admin\Hotel\RoomController;
use App\Http\Controllers\Admin\Hotel\UnitMasterController;
use App\Http\Controllers\Admin\Hotel\MenuCategoryController;
use App\Http\Controllers\Admin\Hotel\StockCenterController;
use App\Http\Controllers\Admin\Hotel\ItemEntryController;
use App\Http\Controllers\Admin\Hotel\OrderRequisitionController;
use App\Http\Controllers\Admin\Hotel\CheckingController;
use App\Http\Controllers\Admin\Hotel\SupplierController;
use App\Http\Controllers\Admin\Hotel\PurchaseController;
use App\Http\Controllers\Admin\Hotel\TaxSettingController;
use App\Http\Controllers\Admin\Hotel\StockTransferController;
use App\Http\Controllers\Admin\Hotel\PurchaseOrderController;

use App\Http\Controllers\Admin\Inventory\InventoryManageController;
use App\Http\Controllers\Admin\Inventory\ReportController;

use App\Http\Controllers\Admin\Hotel\VoucherController;
use App\Http\Controllers\Admin\Hotel\CheckinUpdateController;
use App\Http\Controllers\Admin\Hotel\AdvanceBookingController;


use App\Http\Controllers\Admin\AddonManagerController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\MediaManagerController;






Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// admin routes start
Route::get('admin', [AdminController::class, 'Select'])->name('admin.dashboard');
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.main.dashboard');
Route::get(md5('admin/user/create/'), [AdminController::class, 'create'])->name('admin.user.create');
Route::post('admin/user/create/', [AdminController::class, 'register'])->name('admin.user.register');
Route::get(md5('admin/user'), [AdminController::class, 'alluser'])->name('admin.user');
Route::get('admin/logout', [AdminController::class, 'AdminLogOut'])->name('admin.logout');
Route::get('admin/user/profile/{id}', [AdminController::class, 'profile']);
Route::get('/get/useremployee/all/{employee_id}', [AdminController::class, 'employee']);
Route::get('admin/user/edit/{id}', [AdminController::class, 'edit']);
Route::post('admin/user/update', [AdminController::class, 'update'])->name('admin.user.update');
Route::get('admin/user/view/{id}', [AdminController::class, 'view']);
Route::get('admin/user/delete/{id}', [AdminController::class, 'delete']);
Route::get('admin/user/deactive/{id}', [AdminController::class, 'deactive']);
Route::get('admin/user/active/{id}', [AdminController::class, 'active']);
Route::get(md5('admin/user/password/change'), [AdminController::class, 'passwordchange'])->name('password.chamge');
Route::post(md5('admin/user/password/submit'), [AdminController::class, 'passwordchangesubmit'])->name('admin.passchange.submit');
// email controller
Route::get(md5('admin/email'), [EmailController::class, 'index'])->name('admin.email');
Route::get(md5('admin/compose/email'), [EmailController::class, 'composemail'])->name('admin.compose.email');
Route::post(md5('admin/email/send'), [EmailController::class, 'composemailsend'])->name('admin.email.send');
Route::get('admin/email/softdelete/{id}', [EmailController::class, 'mailsoftdelete']);
Route::get('admin/email/delete/{id}', [EmailController::class, 'delete']);
Route::get('/get/started/change/{dataid}/{val}', [EmailController::class, 'started']);
Route::get('/get/started/uncheked/change/{dataid}/{val}', [EmailController::class, 'unstarted']);
Route::get('/get/view/email/{val}', [EmailController::class, 'view']);
Route::get('/get/individual/email/{val}', [EmailController::class, 'individualemail']);
Route::get('admin/sendemail/delete/{id}', [EmailController::class, 'sendmaildelete']);
//admin login controller
Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/forget/password', [LoginController::class, 'forget']);
Route::post('admin/forget/email/submit', [LoginController::class, 'emailsubmit'])->name('admin.password.email');
Route::get('admin/forget/email/{email}', [LoginController::class, 'forgetemail'])->name('admin.auth.adminverification');
Route::post('admin/forget/verification/code', [LoginController::class, 'checkverification'])->name('admin.verification.code');
Route::get('admin/forget/reset/password/{email}', [LoginController::class, 'forgetresetpassword'])->name('admin.forget.resetpass');
Route::post('admin/forget/reset/password/submit', [LoginController::class, 'forgetresetpasswordsubmit'])->name('admin.password.set');
// settings controller
Route::get(md5('admin/settings/general'), [SettingsController::class, 'Index'])->name('admin.settings.general');
Route::post(md5('admin/settings/general/update'), [SettingsController::class, 'Update'])->name('admin.settings.general.update');
Route::post(md5('admin/settings/logo/update'), [SettingsController::class, 'LogoUpdate'])->name('admin.settings.logo.update');
Route::post(md5('admin/settings/socialmedia/update'), [SettingsController::class, 'SocialMediaUpdate'])->name('admin.settings.socialmedia.update');
Route::post(md5('admin/settings/seo/update'), [SettingsController::class, 'SeoUpdate'])->name('admin.settings.seo.update');
Route::post(md5('admin/settings/sms/update'), [SettingsController::class, 'SmsUpdate'])->name('admin.sms.update');
Route::post(md5('admin/settings/smtp/update'), [SettingsController::class, 'SmtpUpdate'])->name('admin.Smtp.update');
Route::get(md5('admin/settings/check'), [SettingsController::class, 'CheckFilemana'])->name('admin.filemanager.check');
// employee controller
Route::get(md5('admin/employee/index'), [EmployeeController::class, 'index'])->name('admin.employee.index');
Route::get(md5('admin/employee/create'), [EmployeeController::class, 'create'])->name('admin.employee.create');
Route::get('admin/employee/view/{id}', [EmployeeController::class, 'view']);
Route::get('admin/employee/edit/{id}', [EmployeeController::class, 'edit']);
Route::post('admin/employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
Route::post('admin/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
Route::get('admin/employee/delete/{id}', [EmployeeController::class, 'delete']);
Route::get('/get/policestation/all/{district}', [EmployeeController::class, 'getpolicestation'])->name('get.employee.getpolicestation');
// bulk sms Controller
Route::get('admin/bulksms/create', [BulkSmsController::class, 'create'])->name('admin.bulksms.create');
Route::post('admin/bulksms/send', [BulkSmsController::class, 'store'])->name('admin.bulksms.send');
// hotel section ------------------------------------------------------------------------------------------------------------------------
// hotel manage controller
Route::get(md5('admin/hotel'), [HotelManageController::class, 'index'])->name('admin.hotel');
// branch controller
Route::get(md5('admin/branch/index'), [BranchController::class, 'index'])->name('admin.branch.index');
Route::get('admin/branch/create', [BranchController::class, 'create'])->name('admin.branch.create');
Route::post(md5('admin/branch/store'), [BranchController::class, 'store'])->name('admin.branch.store');
Route::get('admin/branch/active/{id}', [BranchController::class, 'active']);
Route::get('admin/branch/deactive/{id}', [BranchController::class, 'deactive']);
Route::get('admin/branch/delete/{id}', [BranchController::class, 'delete']);
Route::get('admin/branch/edit/{id}', [BranchController::class, 'edit']);
Route::post(md5('admin/branch/update'), [BranchController::class, 'update'])->name('admin.branch.update');
// floor controller
Route::get(md5('admin/floor/create'), [FloorController::class, 'create'])->name('admin.floor.create');
Route::post('admin/floor/store', [FloorController::class, 'store'])->name('admin.floor.store');
Route::get('admin/floor/active/{id}', [FloorController::class, 'active']);
Route::get('admin/floor/deactive/{id}', [FloorController::class, 'deactive']);
Route::get('admin/floor/delete/{id}', [FloorController::class, 'delete']);
Route::get('admin/floor/edit/{id}', [FloorController::class, 'edit']);
Route::post(md5('admin/floor/update'), [FloorController::class, 'update'])->name('admin.floor.update');
// roomtype controller
Route::get(md5('admin/roomtype/create'), [RoomTypeController::class, 'create'])->name('admin.rooomtype.create');
Route::post(md5('admin/roomtype/store'), [RoomTypeController::class, 'store'])->name('admin.roomtype.store');
Route::get('admin/roomtype/active/{id}', [RoomTypeController::class, 'active']);
Route::get('admin/roomtype/deactive/{id}', [RoomTypeController::class, 'deactive']);
Route::get('admin/roomtype/delete/{id}', [RoomTypeController::class, 'delete']);
Route::get('admin/roomtype/edit/{id}', [RoomTypeController::class, 'edit']);
Route::post(md5('admin/roomtype/update'), [RoomTypeController::class, 'update'])->name('admin.roomtype.update');
// room controller
Route::get(md5('admin/room/create'), [RoomController::class, 'create'])->name('admin.room.create');
Route::get(md5('admin/room/index'), [RoomController::class, 'index'])->name('admin.room.index');
Route::get('/get/roomsetup/all/{branch}', [RoomController::class, 'getbranchdata']);
Route::get('/get/floorsetup/all/{branch}', [RoomController::class, 'getfloordata']);
Route::get('/get/pricesetup/all/{roomtype}', [RoomController::class, 'getpricedata']);
Route::post(md5('admin/room/store'), [RoomController::class, 'store'])->name('admin.room.store');

Route::get('admin/room/active/{id}', [RoomController::class, 'active']);
Route::get('admin/room/deactive/{id}', [RoomController::class, 'deactive']);
Route::get('admin/room/delete/{id}', [RoomController::class, 'delete']);
Route::get('admin/room/edit/{id}', [RoomController::class, 'edit']);
Route::post(md5('admin/room/update'), [RoomController::class, 'update'])->name('admin.room.update');

// unit master table
Route::get(md5('admin/unit/create'), [UnitMasterController::class, 'create'])->name('admin.unit.create');
Route::post(md5('admin/unit/store'), [UnitMasterController::class, 'store'])->name('admin.unit.store');
Route::get('admin/unit/active/{id}', [UnitMasterController::class, 'active']);
Route::get('admin/unit/deactive/{id}', [UnitMasterController::class, 'deactive']);
Route::get('admin/unit/delete/{id}', [UnitMasterController::class, 'delete']);
Route::get('admin/unit/edit/{id}', [UnitMasterController::class, 'edit']);
Route::post(md5('admin/unit/update'), [UnitMasterController::class, 'update'])->name('admin.unit.update');
// menu category
Route::get(md5('admin/menucategory/create'), [MenuCategoryController::class, 'create'])->name('admin.menucategory.create');
Route::post(md5('admin/menucategory/store'), [MenuCategoryController::class, 'store'])->name('admin.menucategory.store');
Route::get('admin/menucategory/active/{id}', [MenuCategoryController::class, 'active']);
Route::get('admin/menucategory/deactive/{id}', [MenuCategoryController::class, 'deactive']);
Route::get('admin/menucategory/delete/{id}', [MenuCategoryController::class, 'delete']);
Route::get('admin/menucategory/edit/{id}', [MenuCategoryController::class, 'edit']);
Route::post(md5('admin/menucategory/update'), [MenuCategoryController::class, 'update'])->name('admin.menucategory.update');
// stockcenter controller
Route::get(md5('admin/stockcenter/create'), [StockCenterController::class, 'create'])->name('admin.stockcenter.create');
Route::post(md5('admin/stockcenter/store'), [StockCenterController::class, 'store'])->name('admin.stockcenter.store');
Route::get('admin/stockcenter/active/{id}', [StockCenterController::class, 'active']);
Route::get('admin/stockcenter/deactive/{id}', [StockCenterController::class, 'deactive']);
Route::get('admin/stockcenter/delete/{id}', [StockCenterController::class, 'delete']);
Route::get('admin/stockcenter/edit/{id}', [StockCenterController::class, 'edit']);
Route::post(md5('admin/stockcenter/update'), [StockCenterController::class, 'update'])->name('admin.stockcenter.update');
// item entry controller
Route::get(md5('admin/itementry/create'), [ItemEntryController::class, 'create'])->name('admin.itementry.create');
Route::get(md5('admin/itementry/index'), [ItemEntryController::class, 'index'])->name('admin.itementry.index');
Route::post(md5('admin/itementry/store'), [ItemEntryController::class, 'store'])->name('admin.itementry.store');
Route::get('admin/itementry/active/{id}', [ItemEntryController::class, 'active']);
Route::get('admin/itementry/deactive/{id}', [ItemEntryController::class, 'deactive']);
Route::get('admin/itementry/delete/{id}', [ItemEntryController::class, 'delete']);
Route::get('admin/itementry/edit/{id}', [ItemEntryController::class, 'edit']);
Route::post(md5('admin/itementry/update'), [ItemEntryController::class, 'update'])->name('admin.itementry.update');

// order recusition
Route::get(md5('admin/ordercusition/create'), [OrderRequisitionController::class, 'create'])->name('admin.ordercusition.create');
Route::get(md5('admin/ordercusition/index'), [OrderRequisitionController::class, 'index'])->name('admin.ordercusition.index');
Route::get('/get/item/all/{item_name}', [OrderRequisitionController::class, 'getitem']);
Route::post('/get/item/show/{invoice}', [OrderRequisitionController::class, 'allrecuitem'])->name('get.item.show');
Route::post('/get/item/delete/', [OrderRequisitionController::class, 'itemdelete'])->name('get.item.delete');
Route::get('/get/item/insert/', [OrderRequisitionController::class, 'iteminsert'])->name('item.insert.data');
Route::post('/get/item/order/submit/', [OrderRequisitionController::class, 'ordersubmit'])->name('orderhead.submit');
Route::post('/get/oderrecusition/edit/', [OrderRequisitionController::class, 'orderedit'])->name('get.item.edit');
Route::get('admin/ordercusition/edit/{id}', [OrderRequisitionController::class, 'edit']);
Route::post('admin/ordercusition/update/', [OrderRequisitionController::class, 'orderupdate'])->name('orderhead.update');
Route::get('admin/ordercusition/delete/{id}', [OrderRequisitionController::class, 'orderdelete']);


Route::get(md5('admin/supplier/create'), [SupplierController::class, 'create'])->name('admin.supplier.create');
Route::post(md5('admin/supplier/store'), [SupplierController::class, 'store'])->name('admin.supplier.store');
Route::get(md5('admin/supplier/index'), [SupplierController::class, 'index'])->name('admin.supplier.index');
Route::get('admin/supplier/active/{id}', [SupplierController::class, 'active']);
Route::get('admin/supplier/deactive/{id}', [SupplierController::class, 'deactive']);
Route::get('admin/supplier/delete/{id}', [SupplierController::class, 'delete']);
Route::get('admin/supplier/edit/{id}', [SupplierController::class, 'edit']);
Route::post(md5('admin/supplier/update'), [SupplierController::class, 'update'])->name('admin.supplier.update');
// purchase
Route::get(md5('admin/purchase/create'), [PurchaseController::class, 'create'])->name('admin.purchase.create');
Route::post(md5('admin/purchase/insert'), [PurchaseController::class, 'insert'])->name('admin.purchase.insert');
Route::post('admin/purchase/update/{id}', [PurchaseController::class, 'update'])->name('admin.purchase.update');
Route::get(md5('admin/purchase/index'), [PurchaseController::class, 'index'])->name('admin.purchase.index');
Route::get('admin/purchase/active/{id}', [PurchaseController::class, 'active']);
Route::get('admin/purchase/deactive/{id}', [PurchaseController::class, 'deactive']);
Route::get('admin/purchase/delete/{id}', [PurchaseController::class, 'delete']);
Route::get('admin/purchase/edit/{id}', [PurchaseController::class, 'edit']);
Route::post('get/tax/edit/', [PurchaseController::class, 'taxedit'])->name('get.taxitem.edit');
Route::get(md5('get/itempurchase/insert'), [PurchaseController::class, 'itempurchase'])->name('itempurchese.insert.data');
Route::post('get/itempurchase/data/{invoice}', [PurchaseController::class, 'allitemdata']);
Route::post('get/itempurchase/delete/', [PurchaseController::class, 'itempurchasedelete'])->name('get.purchaseitem.delete');
Route::post('get/itempurchase/edit/', [PurchaseController::class, 'purchaseedit'])->name('get.itempurchase.edit');
Route::get('get/tax/data/{tax}', [PurchaseController::class, 'gettax']);
Route::get('get/tax/insert/', [PurchaseController::class, 'taxinsert'])->name('tax.insert.data');
Route::post('get/alltax/data/{invoice}', [PurchaseController::class, 'alltaxinclude']);
Route::post('get/tax/delete/', [PurchaseController::class, 'taxdatadelete'])->name('get.taxdata.delete');
Route::post('get/total/amount/{invoice}', [PurchaseController::class, 'gettotalamount']);
Route::post('get/supplier/modal/insert', [PurchaseController::class, 'supllymodalinsert'])->name('supplier.modalinsert.data');

Route::get('get/allsupplier/supplier', [PurchaseController::class, 'getallsupplier']);
Route::post('get/iteminsert/ajaxdata/', [PurchaseController::class, 'itemajxinsert'])->name('itementery.modalinsert.data');
Route::get('get/allitem/item/', [PurchaseController::class, 'getallpurchaseitem']);

// stock tranfer
Route::get(md5('admin/stocktransfer/create'), [StockTransferController::class, 'create'])->name('admin.stocktransfer.create');
Route::post(md5('admin/stocktransfer/insert'), [StockTransferController::class, 'insert'])->name('admin.stocktransfer.insert');
Route::get(md5('admin/stocktransfer/index'), [StockTransferController::class, 'index'])->name('admin.stocktransfer.index');
Route::get('admin/stocktransfer/edit/{id}', [StockTransferController::class, 'edit']);
Route::get('admin/stocktransfer/delete/{id}', [StockTransferController::class, 'delete']);
Route::post(md5('admin/stocktransfer/update'), [StockTransferController::class, 'update'])->name('admin.stocktransfer.update');
Route::get(md5('get/stocktransfer/stockinsert'), [StockTransferController::class, 'stockinsert'])->name('stocktransfer.insert.data');
Route::post('/get/itemstocktransfer/data/{invoice}', [StockTransferController::class, 'getstocktitem']);
Route::post('get/totalitem/count/{invoice}', [StockTransferController::class, 'getstockitem']);
Route::post('get/totalitem/stocktranfer/', [StockTransferController::class, 'getstocktransdelete'])->name('get.stocktransferitem.delete');
Route::post('get/totalitem/stocktranfer/edit', [StockTransferController::class, 'getstocktransedit'])->name('get.itemstocktransfer.edit');

// purchase order
Route::get(md5('admin/purchaseorder/create'), [PurchaseOrderController::class, 'create'])->name('admin.purchaseorder.create');
Route::get(md5('admin/purchaseorderajax/insert'), [PurchaseOrderController::class, 'purchaseorderinsert'])->name('purchaseorder.insert.data');
Route::post('/get/purchaseorrder/data/{invoice}', [PurchaseOrderController::class, 'getpurchaseorder']);
Route::post(md5('admin/purchaseorderajax/edit'), [PurchaseOrderController::class, 'getpurchaseorderedit'])->name('get.purchaseorder.edit');
Route::post(md5('admin/purchaseorderajax/delete'), [PurchaseOrderController::class, 'getpurchaseorderdelete'])->name('get.purchaseorder.delete');
Route::post('get/purchaseorder/count/{invoice}', [PurchaseOrderController::class, 'getpurchaseordercount']);
Route::post(md5('admin/purchaseorder/insert'), [PurchaseOrderController::class, 'insert'])->name('admin.purchaseorder.insert');
Route::get(md5('admin/purchaseorder/index'), [PurchaseOrderController::class, 'index'])->name('admin.purchaseorder.index');
Route::get('admin/purchaseorder/delete/{id}', [PurchaseOrderController::class, 'delete']);
Route::get('admin/purchaseorder/edit/{id}', [PurchaseOrderController::class, 'edit']);
Route::post('admin/purchaseorder/update/{id}', [PurchaseOrderController::class, 'update'])->name('admin.purchaseorder.update');

// report controller
Route::get(md5('admin/inventory/home'), [InventoryManageController::class, 'index'])->name('admin.inventory.home');
// daily purchase report
Route::get(md5('admin/dailypurchase/index'), [ReportController::class, 'dailypurchase'])->name('admin.dailypurchase.create');
Route::post(md5('admin/dailypurchase/index'), [ReportController::class, 'dailypurchasesearch'])->name('admin.dailypurchase.create');
// // Stockwise purchase report
Route::get(md5('admin/stockwise/purchase/create'), [ReportController::class, 'stockwise'])->name('admin.stockwise.create');
Route::post(md5('admin/stockwise/purchase/create'), [ReportController::class, 'stockwisesearch'])->name('admin.stockwise.create');
// 
Route::get(md5('admin/categorywise/purchase/create'), [ReportController::class, 'categorywisereport'])->name('admin.categorywise.report');
Route::post(md5('admin/categorywise/purchase/create'), [ReportController::class, 'categoriwise'])->name('admin.categorywise.report');

Route::get(md5('admin/supplierwise/purchase/create'), [ReportController::class, 'supplierwisereport'])->name('admin.supplierwise.report');
Route::post(md5('admin/supplierwise/purchase/create'), [ReportController::class, 'supplierwise'])->name('admin.supplierwise.report');

// datewise
Route::get(md5('admin/datewise/purchase/create'), [ReportController::class, 'datewisereport'])->name('admin.datewise.report');




// setting area start here
Route::middleware(['admin'])->prefix(md5('admin/tax'))->group(function () {
    Route::get('/', [TaxSettingController::class, 'index'])->name('admin.tax.index');
    Route::post('/store', [TaxSettingController::class, 'store'])->name('admin.tax.store');
    Route::get('/delete/{id}', [TaxSettingController::class, 'delete'])->name('admin.taxsetting.delete');
    Route::get('/status/{id}', [TaxSettingController::class, 'status'])->name('admin.taxsetting.status');
    Route::get('/edit/{id}', [TaxSettingController::class, 'edit'])->name('admin.taxsetting.edit');
    Route::post('/update/{id}', [TaxSettingController::class, 'update'])->name('admin.tax.update'); 
});

// checking area start from here

Route::middleware(['admin'])->prefix(md5('admin/check-in'))->group(function () {
    Route::get('/{id}', [CheckingController::class, 'index'])->name('admin.checking.index');
    Route::get('/get/hostel', [CheckingController::class, 'getRoom'])->name('admin.get.hotel');
    Route::post('/checkin/store', [CheckingController::class, 'store'])->name('admin.checkin.store');


    Route::get('/report/show', [CheckingController::class, 'checkinReport'])->name('admin.checkin.report');
    Route::get('/report/edit/{id?}', [CheckingController::class, 'checkinEdit'])->name('admin.checkin.edit');

    Route::post('/service/store', [CheckingController::class, 'serviceStore'])->name('admin.checkin.service.add');
    Route::post('/service/update', [CheckingController::class, 'serviceUpdate'])->name('admin.checkin.service.update');

    Route::get('/get/service/{id}', [CheckingController::class, 'getService'])->name('admin.checkin.get.service');

    Route::get('/get/delete/service/{id}', [CheckingController::class, 'deleteService'])->name('admin.checkin.get.delete.service');

    Route::get('/get/deleted/service/{id}', [CheckingController::class, 'deletedService'])->name('admin.checkin.get.deleted.service');

    Route::get('/get/deleted/service/{id}', [CheckingController::class, 'deletedService'])->name('admin.checkin.get.deleted.service');

    Route::get('/get/view/service/{id}', [CheckingController::class, 'viewService'])->name('admin.checkin.get.view.service');

    Route::get('/print/service/{id}', [CheckingController::class, 'printService'])->name('admin.print.service');
});

Route::middleware(['admin'])->prefix(md5('admin/voucher'))->group(function () {
    Route::get('/create', [VoucherController::class, 'create'])->name('admin.voucher.create');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/room/change/{id}', [CheckinUpdateController::class, 'getNewRoomtarif']);
    Route::post('/room/change', [CheckinUpdateController::class, 'roomChange'])->name('admin.room.change');
    Route::post('/guest/update/{id}', [CheckinUpdateController::class, 'guestUpdate'])->name('admin.guest.update');
    Route::get('/edit/book-in/{id}', [CheckinUpdateController::class, 'editBookingShow'])->name('admin.edit.booking');
    Route::post('/edit/book-in/update/{id}', [CheckinUpdateController::class, 'bookingUpdate'])->name('admin.bookin.update');
    Route::post('/edit/tariff/update/{id}', [CheckinUpdateController::class, 'tariffUpdate'])->name('admin.tarif.update');
    Route::get('/delete/booking/{id}', [CheckinUpdateController::class, 'deleteBooking'])->name('admin.delete.booking');
});


Route::middleware(['admin'])->prefix('admin/advance/booking')->group(function () {
    Route::get('/', [AdvanceBookingController::class, 'showAdvanceBookingForm'])->name('admin.advance.booking');
    Route::get('/get/room/{id}', [AdvanceBookingController::class, 'advanceBookingGetRoom']);
    Route::post('/guest/name/store', [AdvanceBookingController::class, 'guestNameStore'])->name('admin.guest.name.store');
    Route::post('/advance/booking/store', [AdvanceBookingController::class, 'advanceBookingStore'])->name('admin.advance.booking.store');
    Route::get('/check/{id}', [AdvanceBookingController::class, 'advanceBookingCheck']);

});
Route::middleware(['admin'])->prefix('admin/advance/report')->group(function () {
    Route::get('/', [AdvanceBookingController::class, 'showAdvanceBookingReportPage'])->name('admin.advance.booking.report');
    Route::get('/edit/{id}', [AdvanceBookingController::class, 'showAdvanceBookingReportEdit'])->name('admin.advance.booking.report.edit');
    Route::post('/update/{id}', [AdvanceBookingController::class, 'showAdvanceBookingReportUpdate'])->name('admin.advance.booking.update');
    Route::get('/delete/{id}', [AdvanceBookingController::class, 'deleteAdvanceBookingReport'])->name('admin.advance.booking.delete');
    Route::get('/status/{id}', [AdvanceBookingController::class, 'statusAdvanceBookingReport'])->name('admin.advance.booking.status');
    

});
















// hotel section end --------------------------------------------------------------------------------------------------------------------

// frontend controller
Route::get('account', [FrontendController::class, 'index'])->name('customar.account');

// Addon Section start from here

Route::get('/addon/manager',[AddonManagerController::class, 'index'])->name('admin.addon.manager');
Route::post('/addon/install',[AddonManagerController::class, 'store'])->name('admin.addon.install');
Route::post('/addon/status',[AddonManagerController::class, 'status'])->name('admin.addon.status');
Route::get('/addon/delete/{id}',[AddonManagerController::class, 'delete'])->name('admin.addon.delete');

// Pages area start



Route::get('/page',[MediaManagerController::class, 'insert'])->name('page');
Route::post('/media',[MediaManagerController::class, 'mediaManager'])->name('admin.media.file.upload');
Route::post('/get/image',[MediaManagerController::class, 'getImage'])->name('admin.media.file.use');
Route::get('/show/image',[MediaManagerController::class, 'showImage'])->name('admin.media.file.show');
Route::get('/media/manager/pagination/{id}',[MediaManagerController::class, 'showPaginationImage'])->name('admin.media.manager.pagination');
Route::get('admin/media/manager/delete/{id}',[MediaManagerController::class, 'mediaDelete']);
Route::get('test',[MediaManagerController::class, 'test']);