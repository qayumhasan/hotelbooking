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
use App\Http\Controllers\Admin\Hotel\SupplierController;
use App\Http\Controllers\Admin\Hotel\PurchaseController;

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

// supplier
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
Route::get(md5('get/itempurchase/insert'), [PurchaseController::class, 'itempurchase'])->name('itempurchese.insert.data');




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