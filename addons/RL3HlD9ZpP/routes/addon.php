<?php
use App\Http\Controllers\addon\EmployeeController;
Route::get('admin/test/employee', [EmployeeController::class, 'index'])->name('admin.employee.test.index');


// employee controller
Route::get(md5('admin/employee/index'), [EmployeeController::class, 'index'])->name('admin.employee.index');
Route::get(md5('admin/employee/create'), [EmployeeController::class, 'create'])->name('admin.employee.create');
Route::get('admin/employee/view/{id}', [EmployeeController::class, 'view']);
Route::get('admin/employee/edit/{id}', [EmployeeController::class, 'edit']);
Route::post('admin/employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
Route::post('admin/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
Route::get('admin/employee/delete/{id}', [EmployeeController::class, 'delete']);