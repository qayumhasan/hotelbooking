<?php
use App\Http\Controllers\Admin\Restaurant\RestaurantController;
use App\Http\Controllers\Admin\Restaurant\Chui\ChuiController;
use App\Http\Controllers\Admin\Restaurant\Chui\MenuController;

Route::get('/restaurant',[RestaurantController::class, 'index'])->name('admin.restaurant.index');

Route::middleware('admin')->prefix(md5('admin/chui'))->group(function(){
    Route::get('/',[ChuiController::class,'chuiIndex'])->name('admin.chui.restaurant');

        Route::prefix(md5('menu/category'))->group(function(){
            Route::get('/',[MenuController::class,'menuCategory'])->name('admin.restaurant.menu.category');
            Route::post('/update',[MenuController::class,'menuCategoryUpdate'])->name('admin.restaurant.chui.menu.category.update');
            Route::post('/store',[MenuController::class,'menuCategoryStore'])->name('admin.restaurant.chui.menu.category.store');
        });

        // menu config area start

        Route::prefix(md5('menu/config'))->group(function(){
            Route::get('/',[MenuController::class,'menuConfig'])->name('admin.restaurant.chui.menu.config');
            Route::get('/create',[MenuController::class,'menuConfigCreate'])->name('admin.restaurant.chui.menu.config.create');
            Route::post('/store',[MenuController::class,'menuConfigStore'])->name('admin.restaurant.chui.menu.config.store');
            Route::get('/status/{id}',[MenuController::class,'menuConfigStatus'])->name('admin.restaurant.chui.menu.config.status');
            Route::get('/edit/{id}',[MenuController::class,'menuConfigEdit'])->name('admin.restaurant.chui.menu.config.edit');
            Route::post('/update',[MenuController::class,'menuConfigUpdate'])->name('admin.restaurant.chui.menu.config.update');
            Route::get('/delete/{id}',[MenuController::class,'menuConfigDelete'])->name('admin.restaurant.chui.menu.config.delete');
        });

        Route::prefix(md5('menu/inventory'))->group(function(){

            Route::get('/',[MenuController::class,'menuInventory'])->name('admin.restaurant.chui.menu.inventory');
        });
    
    


});