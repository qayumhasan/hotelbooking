<?php
use App\Http\Controllers\Admin\Restaurant\RestaurantController;
use App\Http\Controllers\Admin\Restaurant\Chui\ChuiController;
use App\Http\Controllers\Admin\Restaurant\Chui\MenuController;

use App\Http\Controllers\Admin\Restaurant\ReportsController;

use App\Http\Controllers\Admin\Restaurant\Chui\OtherInfoController;
use App\Http\Controllers\Admin\Restaurant\Chui\MovingReportController;
use App\Http\Controllers\Admin\Restaurant\Chui\WaiterReportController;


Route::get('/restaurant',[RestaurantController::class, 'index'])->name('admin.restaurant.index');

Route::middleware('admin')->prefix(md5('admin/chui'))->group(function(){
    Route::get('/',[ChuiController::class,'chuiIndex'])->name('admin.chui.restaurant');
    
    Route::get('/billing/print/{id}',[ChuiController::class,'billingInfoPrint'])->name('admin.chui.restaurant.tax.print');

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
            Route::post('/history/search',[OtherInfoController::class,'KotHistorySearch'])->name('admin.restaurant.chui.menu.kot.history.search');
            Route::get('/in/house/geust',[OtherInfoController::class,'inHouseGuest'])->name('admin.restaurant.chui.menu.kot.inhouse.guest');
            // tax delete
            Route::get('/tax/edit/{id}',[ChuiController::class,'kotTaxEdit'])->name('admin.resturant.kot.tax.edit');

            Route::get('/tax/delete/{id}',[ChuiController::class,'kotTaxDelete'])->name('admin.resturant.kot.tax.delete');
            
        });

        

        Route::prefix(md5('/admin/restaurant/moving/item'))->group(function(){

            Route::get('/fast',[MovingReportController::class,'fastMovingItemPage'])->name('admin.restaurant.chui.menu.Kot.fast.moving.page');

            Route::post('/fast/search',[MovingReportController::class,'fastMovingItemSearch'])->name('admin.restaurant.chui.menu.fast.moving.item.search');

            Route::post('/slow/search',[MovingReportController::class,'slowMovingItemSearch'])->name('admin.restaurant.chui.menu.Kot.slow.moving.search');

            
            Route::get('/slow',[MovingReportController::class,'slowMovingItemPage'])->name('admin.restaurant.chui.menu.Kot.slow.moving.page');

            Route::post('/non/moving/search',[MovingReportController::class,'nonMovingItemSearch'])->name('admin.restaurant.chui.menu.Kot.non.moving.search');

            
            Route::get('/non/moving',[MovingReportController::class,'nonMovingItemPage'])->name('admin.restaurant.chui.menu.Kot.non.moving.page');

        });


        Route::prefix(md5('/admin/restaurant/waiter/performance'))->group(function(){
            Route::get('/qtr',[WaiterReportController::class,'qtrWaiterPerformance'])->name('admin.restaurant.chui.menu.Kot.waiter.qtr.sale.performance');
            Route::get('/total/sale',[WaiterReportController::class,'totalWaiterSale'])->name('admin.restaurant.chui.menu.Kot.waiter.total.sale');
            Route::post('/search',[WaiterReportController::class,'totalWaiterSaleSearch'])->name('admin.restaurant.chui.menu.Kot.waiter.sale.serarch');
        }); 



  
    
    


});


Route::prefix(md5('/admin/accounts'))->group(function(){
    Route::get('/cash',[ChuiController::class,'getCashAccount'])->name('admin.restaurant.get.cash.account');
    Route::get('/bank',[ChuiController::class,'getBankAccount'])->name('admin.restaurant.get.bank.account');
});


Route::prefix(md5('/admin/credit'))->group(function(){
    Route::get('/customar',[ChuiController::class,'getCreditCustomar'])->name('admin.restaurant.credit.customar');
    Route::get('/voucher/{id}',[ChuiController::class,'getCreditVoucher'])->name('admin.restaurant.credit.customar.voucher');
});


Route::prefix(md5('/admin/report'))->group(function(){
    Route::get('/date/wise',[ReportsController::class,'getDateWiseReport'])->name('admin.restaurant.date.wise.report');
    Route::get('/payment/method/wise',[ReportsController::class,'getPaymentMethodWise'])->name('admin.restaurant.payment.method.wise.report');

    Route::post('/date/wise/ajax',[ReportsController::class,'dateWiseAjaxReport'])->name('admin.date.wise.ajax.list');
    Route::post('/payment/method/wise/ajax',[ReportsController::class,'paymentMethodWiseAjaxReport'])->name('admin.payment.method.wise.ajax.list');
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
Route::post('/admin/restaurant/chui/menu/history/kot/store',[ChuiController::class,'storeKotItemHistoryByTableID']);

Route::get('/admin/restaurant/chui/menu/get/at/glance/item/{id}',[ChuiController::class,'getKotItematglanceByTableID']);
//reports controller by asif
Route::get('/admin/restaurant/itemwisesell/reports',[ReportsController::class,'itemwisesell'])->name('admin.restaurant.itemwisesell.report');
Route::post('/admin/restaurant/itemwisesell/reports',[ReportsController::class,'itemwisesellreports'])->name('admin.restaurant.itemwisesell.report');

Route::get('/admin/restaurant/item/view/{id}',[ReportsController::class,'viewdata']);

Route::get('/admin/restaurant/categorywisesell/reports',[ReportsController::class,'categorysell'])->name('admin.restaurant.categorywise.report');
Route::post('/admin/restaurant/categorywisesell/reports',[ReportsController::class,'categorysellreports'])->name('admin.restaurant.categorywise.report');


Route::get('/admin/restaurant/chui/menu/get/at/glance/item/{id}',[ChuiController::class,'getKotItematglanceByTableID']);

Route::get('/admin/restaurant/chui/menu/get/print/invoice/item/{id}',[ChuiController::class,'getKotItematglanceByInvoiceID']);

Route::post('/admin/restaurant/chui/menu/get/tax/value',[ChuiController::class,'getKotItemTaxValue']);
Route::post('/admin/restaurant/chui/menu/get/tax/calculate',[ChuiController::class,'getKotItemTaxCalculate']);

Route::get('/admin/restaurant/chui/menu/get/tax/item/{id}',[ChuiController::class,'getKotTaxItem']);

Route::post('/admin/restaurant/chui/menu/tax/add/to/grid',[ChuiController::class,'addToGridKotBillingItem']);

// asif route history
Route::get('/admin/restaurant/chui/gethistory/{t_id}',[ChuiController::class,'getHistory']);
Route::get('/admin/restaurant/chui/getataglance/{t_id}',[ChuiController::class,'getataglance']);
Route::get('/admin/restaurant/chui/getsearch/history/',[ChuiController::class,'gethistorysearch']);

Route::get('/admin/restaurant/chui/menu/select/room',[ChuiController::class,'slectRoomForBilling']);
Route::get('/admin/restaurant/chui/menu/select/room/data/get/{id}',[ChuiController::class,'slectRoomForBillingGet']);


Route::get('/admin/restaurant/chui/menu/history/kot/print/{id}',[ChuiController::class,'billingInfoPrint']);
Route::post('/admin/restaurant/chui/menu/tax/add/to/grid/update',[ChuiController::class,'kotTaxUpdate']);


