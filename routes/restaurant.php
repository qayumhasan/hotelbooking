<?php
use App\Http\Controllers\Admin\Restaurant\RestaurantController;
use App\Http\Controllers\Admin\Restaurant\Chui\ChuiController;

Route::get('/restaurant',[RestaurantController::class, 'index'])->name('admin.restaurant.index');

Route::middleware('admin')->prefix(md5('admin/chui'))->group(function(){
    Route::get('/',[ChuiController::class,'chuiIndex'])->name('admin.chui.restaurant');
    


});