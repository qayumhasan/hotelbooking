<?php

use App\Http\Controllers\Admin\Account\AccountsController;
use App\Http\Controllers\Admin\Account\AccountCategoryController;
use App\Http\Controllers\Admin\Account\AccountMainCategoryController;
use App\Http\Controllers\Admin\Account\AccountSubCategoryController;
use App\Http\Controllers\Admin\Account\ChartOfAccountController;
use App\Http\Controllers\Admin\Account\AccountTrasectionController;
use App\Http\Controllers\Admin\Account\CheckBookController;




Route::get('/admin/account',[AccountsController::class, 'home'])->name('admin.account.home');
Route::get('/admin/account/category',[AccountCategoryController::class, 'create'])->name('admin.account.category.create');
Route::post('/admin/account/category',[AccountCategoryController::class, 'store'])->name('admin.account.category.create');
Route::post('/admin/account/category/update',[AccountCategoryController::class, 'update'])->name('admin.account.category.update');
Route::get('admin/account/category/active/{id}', [AccountCategoryController::class, 'active']);
Route::get('admin/account/category/deactive/{id}', [AccountCategoryController::class, 'deactive']);
Route::get('admin/account/category/edit/{id}', [AccountCategoryController::class, 'edit']);
//account controller
Route::get('/admin/account/maincategory',[AccountMainCategoryController::class, 'create'])->name('admin.account.maincategory.create');
Route::post('/admin/account/maincategory',[AccountMainCategoryController::class, 'store'])->name('admin.account.maincategory.create');
Route::post('/admin/account/maincategory/update',[AccountMainCategoryController::class, 'update'])->name('admin.account.maincategory.update');
Route::get('admin/account/maincategory/active/{id}', [AccountMainCategoryController::class, 'active']);
Route::get('admin/account/maincategory/deactive/{id}', [AccountMainCategoryController::class, 'deactive']);
Route::get('admin/account/maincategory/edit/{id}', [AccountMainCategoryController::class, 'edit']);
Route::get('admin/accounts/maincategory/delete/{id}', [AccountMainCategoryController::class, 'delete']);
// subcatgeory one
Route::get('/admin/account/subcategoryone',[AccountSubCategoryController::class, 'createone'])->name('admin.account.subcategoryone.create');
Route::post('/admin/account/subcategoryone',[AccountSubCategoryController::class, 'storeone'])->name('admin.account.subcategoryone.create');
Route::get('admin/account/subcategoryone/active/{id}', [AccountSubCategoryController::class, 'active']);
Route::get('admin/account/subcategoryone/deactive/{id}', [AccountSubCategoryController::class, 'deactive']);
Route::get('admin/account/subcategoryone/edit/{id}', [AccountSubCategoryController::class, 'edit']);
Route::get('admin/accounts/subcategoryone/delete/{id}', [AccountSubCategoryController::class, 'delete']);
Route::post('/admin/account/subcategoryone/update',[AccountSubCategoryController::class, 'updateone'])->name('admin.account.subcategoryone.update');
// subacategory two
Route::get('/admin/account/subcategorytwo',[AccountSubCategoryController::class, 'createtwo'])->name('admin.account.subcategorytwo.create');
Route::post('/admin/account/subcategorytwo',[AccountSubCategoryController::class, 'storetwo'])->name('admin.account.subcategorytwo.store');
Route::post('/admin/account/subcategorytwo/update',[AccountSubCategoryController::class, 'updatetwo'])->name('admin.account.subcategorytwo.update');
Route::get('admin/account/subcategorytwo/active/{id}', [AccountSubCategoryController::class, 'activetwo']);
Route::get('admin/account/subcategorytwo/deactive/{id}', [AccountSubCategoryController::class, 'deactivetwo']);
Route::get('admin/account/subcategorytwo/edit/{id}', [AccountSubCategoryController::class, 'edittwo']);
Route::get('admin/accounts/subcategorytwo/delete/{id}', [AccountSubCategoryController::class, 'deletetwo']);


// chart of account
Route::get('admin/chartofaccount/create', [ChartOfAccountController::class, 'create'])->name('admin.chartofaccount.create');
Route::post('admin/chartofaccount/create', [ChartOfAccountController::class, 'store'])->name('admin.chartofaccount.create');
Route::get('/get/account/maincategory/all/{cate_id}', [ChartOfAccountController::class, 'maincate']);
Route::get('/get/account/subcategoryone/all/{maincate_id}', [ChartOfAccountController::class, 'subcateone']);
Route::get('/get/account/subcategorytwo/all/{subcateone_id}', [ChartOfAccountController::class, 'subcatetwo']);
Route::get('admin/chartofaccount/index', [ChartOfAccountController::class, 'index'])->name('admin.chartofaccount.index');

Route::get('admin/chartofaccount/active/{id}', [ChartOfAccountController::class, 'active']);
Route::get('admin/chartofaccount/deactive/{id}', [ChartOfAccountController::class, 'deactive']);
Route::get('admin/chartofaccount/edit/{id}', [ChartOfAccountController::class, 'edit']);
Route::get('admin/chartofaccount/delete/{id}', [ChartOfAccountController::class, 'delete']);
Route::post('admin/chartofaccount/update', [ChartOfAccountController::class, 'update'])->name('admin.chartofaccount.update');

Route::get('admin/account/transectionhead/create', [AccountTrasectionController::class, 'create'])->name('admin.transection.create');
Route::post('admin/account/transectionhead/create', [AccountTrasectionController::class, 'insertfinal'])->name('admin.transection.create');
Route::get('admin/account/transectionhead/index', [AccountTrasectionController::class, 'index'])->name('admin.transection.index');
Route::get('admin/account/transectionhead/active/{id}', [AccountTrasectionController::class, 'active']);
Route::get('admin/account/transectionhead/deactive/{id}', [AccountTrasectionController::class, 'deactive']);
Route::get('admin/account/transectionhead/edit/{id}', [AccountTrasectionController::class, 'edit']);
Route::get('admin/account/transectionhead/delete/{id}', [AccountTrasectionController::class, 'delete']);
Route::post('admin/account/transectionhead/update', [AccountTrasectionController::class, 'update'])->name('admin.transection.update');



Route::get('/get/account/cateid/{cate_id}', [AccountTrasectionController::class, 'getaccount']);
Route::get('/get/account/mainaccountcate/{accountid}', [AccountTrasectionController::class, 'getsubcateone']);
Route::get('/get/account/subaccountcate/{subcateone_id}', [AccountTrasectionController::class, 'getsubcatetwo']);
Route::get('admin/transectiondetails/insert', [AccountTrasectionController::class, 'transectiondetailsinsert'])->name('account.transection.insert');
Route::post('admin/transectiondetails/edit', [AccountTrasectionController::class, 'transectiondetailsedit'])->name('get.alldatatransection.edit');
Route::post('/get/alldatatransection/data/{invoice}', [AccountTrasectionController::class, 'gettransectiondetails']);
Route::post('admin/transectiondetails/delete', [AccountTrasectionController::class, 'transectiondelete'])->name('get.transection.delete');
// checkbook controller
Route::get('admin/checkbook/create', [CheckBookController::class, 'create'])->name('admin.checkbook.create');
Route::get('/get/account/checkbook/entry/{bank_code}', [CheckBookController::class, 'getallcheckentry']);
Route::get('admin/account/checktransectiondetails/insert', [CheckBookController::class, 'chekcbooktransectioninsert'])->name('account.checktransectiondetails.insert');
Route::get('admin/account/checktransectiondetails/show', [CheckBookController::class, 'chekcbooktransectionshow'])->name('account.checktransectiondetails.showitem');

Route::get('/get/account/status/bankentry/all/{bank_code}', [CheckBookController::class, 'getbankallstatus']);

Route::get('/get/account/showallstatus/bankentry/{status_show_book_id}', [CheckBookController::class, 'getshowstatusdata']);
