<?php

use App\Http\Controllers\Admin\Account\AccountsController;
use App\Http\Controllers\Admin\Account\AccountCategoryController;
use App\Http\Controllers\Admin\Account\AccountMainCategoryController;
use App\Http\Controllers\Admin\Account\AccountSubCategoryController;
use App\Http\Controllers\Admin\Account\ChartOfAccountController;




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