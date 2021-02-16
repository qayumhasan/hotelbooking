<?php

use App\Http\Controllers\Admin\Account\AccountsController;
use App\Http\Controllers\Admin\Account\AccountCategoryController;
use App\Http\Controllers\Admin\Account\AccountMainCategoryController;
use App\Http\Controllers\Admin\Account\AccountSubCategoryController;

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
// subcatgeory
Route::get('/admin/account/subcategoryone',[AccountSubCategoryController::class, 'createone'])->name('admin.account.subcategoryone.create');