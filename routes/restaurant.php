<?php
use App\Http\Controllers\Admin\Restaurant\RestaurantController;
use App\Http\Controllers\Admin\Restaurant\Chui\ChuiController;
use App\Http\Controllers\Admin\Restaurant\Chui\MenuController;
use App\Http\Controllers\Admin\Restaurant\Chui\OtherInfoController;


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
            Route::post('/store',[MenuController::class,'menuInventoryStore'])->name('admin.restaurant.chui.menu.inventory.store');
            Route::get('/edit/{id}',[MenuController::class,'menuInventoryEdit'])->name('admin.restaurant.chui.menu.inventory.edit');
            Route::post('/update',[MenuController::class,'menuInventoryUpdate'])->name('admin.restaurant.chui.menu.inventory.update');
            Route::get('/delete/{id}',[MenuController::class,'menuInventoryDelete'])->name('admin.restaurant.chui.menu.inventory.delete');
        });

        Route::prefix(md5('side/menu'))->group(function(){
            Route::get('/',[MenuController::class,'SideMenu'])->name('admin.restaurant.chui.menu.side');
            Route::get('/store',[MenuController::class,'SideMenuStore'])->name('admin.restaurant.chui.menu.side.store');
            Route::get('/delete/{main_id}/{side_id}',[MenuController::class,'SideMenuDelete'])->name('admin.restaurant.chui.side.menu.delete');
        });

        Route::prefix(md5('restaurant/kot'))->group(function(){
            Route::post('/',[ChuiController::class,'storeKotDetails'])->name('admin.restaurant.chui.menu.kot.details.store');
            Route::post('/store',[ChuiController::class,'storeKot'])->name('admin.restaurant.chui.menu.kot.store');
            Route::get('/delete/{id}',[ChuiController::class,'kothistorydelete'])->name('admin.restaurant.chui.menu.kot.history.delete');

            // other info menu

            Route::get('/history',[OtherInfoController::class,'OtherInfo'])->name('admin.restaurant.menu.Kot.history');
            
        });


  
    
    


});

// Ajax route start from here

Route::get('/admin/restaurant/chui/menu/inventory/get/items/{id}',[MenuController::class,'menuInventoryGetItem']);
Route::get('/admin/restaurant/chui/menu/side/menu/items/{id}',[MenuController::class,'menuSideMenuItem']);
Route::get('/admin/restaurant/chui/menu/get/free/item/{id}',[ChuiController::class,'getFreemenuSideMenuItem']);


Route::get('/admin/restaurant/chui/menu/kot/details/store{id}',[ChuiController::class,'getFreemenuSideMenuItem']);
Route::get('/admin/restaurant/chui/menu/get/kot/item/{id}',[ChuiController::class,'getKotStatusByTableID']);
Route::get('/admin/restaurant/chui/menu/delete/kot/item/{id}',[ChuiController::class,'deleteKotStatusByTableID']);
Route::get('/admin/restaurant/chui/menu/edit/kot/item/{id}',[ChuiController::class,'editKotStatusByTableID']);
Route::get('/admin/restaurant/chui/menu/history/kot/item/{id}',[ChuiController::class,'getKotItemHistoryByTableID']);
Route::get('/admin/restaurant/chui/menu/history/kot/store/{id}',[ChuiController::class,'storeKotItemHistoryByTableID']);

Route::get('/admin/restaurant/chui/menu/get/at/glance/item/{id}',[ChuiController::class,'getKotItematglanceByTableID']);

Route::get('/admin/restaurant/chui/menu/get/print/invoice/item/{id}',[ChuiController::class,'getKotItematglanceByInvoiceID']);