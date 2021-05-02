<?php

use App\Http\Controllers\Admin\Account\AccountsController;
use App\Http\Controllers\Admin\Account\AccountCategoryController;
use App\Http\Controllers\Admin\Account\AccountMainCategoryController;
use App\Http\Controllers\Admin\Account\AccountSubCategoryController;
use App\Http\Controllers\Admin\Account\ChartOfAccountController;
use App\Http\Controllers\Admin\Account\AccountTrasectionController;
use App\Http\Controllers\Admin\Account\CheckBookController;
use App\Http\Controllers\Admin\Account\ReportsController;




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
// cate code get
Route::get('/get/account/maincategory/code/{cate_id}', [ChartOfAccountController::class, 'getmaincatecode']);
// cate code get end
Route::get('/get/account/subcategoryone/all/{maincate_id}', [ChartOfAccountController::class, 'subcateone']);
Route::get('/get/account/subcategoryone/code/{maincate_id}', [ChartOfAccountController::class, 'getcatemaincode']);

Route::get('/get/account/subcategorytwo/all/{subcateone_id}', [ChartOfAccountController::class, 'subcatetwo']);
Route::get('/get/account/subcategorytwo/code/{subcateone_id}', [ChartOfAccountController::class, 'getsubcateonecode']);
Route::get('/get/account/subcategorythree/code/{subcateone_id}', [ChartOfAccountController::class, 'getsubcatetwocode']);

Route::get('admin/chartofaccount/index', [ChartOfAccountController::class, 'index'])->name('admin.chartofaccount.index');

Route::get('admin/chartofaccount/active/{id}', [ChartOfAccountController::class, 'active']);
Route::get('admin/chartofaccount/deactive/{id}', [ChartOfAccountController::class, 'deactive']);
Route::get('admin/chartofaccount/edit/{id}', [ChartOfAccountController::class, 'edit']);
Route::get('admin/chartofaccount/delete/{id}', [ChartOfAccountController::class, 'delete']);
Route::post('admin/chartofaccount/update', [ChartOfAccountController::class, 'update'])->name('admin.chartofaccount.update');

Route::get('admin/account/transectionhead/create', [AccountTrasectionController::class, 'create'])->name('admin.transection.create');
Route::post('admin/account/transectionhead/create', [AccountTrasectionController::class, 'insertfinal'])->name('admin.transection.create');

Route::get('admin/account/transectionhead/index', [AccountTrasectionController::class, 'index'])->name('admin.transection.index');
Route::post('admin/account/transectionhead/index', [AccountTrasectionController::class, 'searchdatewise'])->name('admin.transection.index');

Route::get('admin/account/transectionhead/printacchead', [AccountTrasectionController::class, 'printvalueaccount'])->name('adminaccount.print.voucheraccount');

Route::get('admin/account/transectionhead/active/{id}', [AccountTrasectionController::class, 'active']);
Route::get('admin/account/transectionhead/deactive/{id}', [AccountTrasectionController::class, 'deactive']);
Route::get('admin/account/transectionhead/edit/{id}', [AccountTrasectionController::class, 'edit']);
Route::get('admin/account/transectionhead/delete/{id}', [AccountTrasectionController::class, 'delete']);
Route::post('admin/account/transectionhead/update/{id}', [AccountTrasectionController::class, 'update'])->name('admin.transection.update');



Route::get('/get/account/cateid/{cate_id}', [AccountTrasectionController::class, 'getaccount']);
Route::get('/get/account/mainaccountcate/{accountid}', [AccountTrasectionController::class, 'getsubcateone']);
Route::get('/get/account/subaccountcate/{subcateone_id}', [AccountTrasectionController::class, 'getsubcatetwo']);
Route::get('admin/transectiondetails/insert', [AccountTrasectionController::class, 'transectiondetailsinsert'])->name('account.transection.insert');
Route::post('admin/transectiondetails/edit', [AccountTrasectionController::class, 'transectiondetailsedit'])->name('get.alldatatransection.edit');
Route::post('/get/alldatatransection/data/{invoice}', [AccountTrasectionController::class, 'gettransectiondetails']);
Route::post('admin/transectiondetails/delete', [AccountTrasectionController::class, 'transectiondelete'])->name('get.transection.delete');


Route::get('/get/admin/vouchertype/sourchaccount/{voucher_type}', [AccountTrasectionController::class, 'getvoucherassourchacc']);
Route::get('/get/admin/vouchertype/accountheadaccount/{voucher_type}', [AccountTrasectionController::class, 'getvoucheraccounthead']);
// voucher typewise payment

Route::get('admin/account/transectionhead/cpv/create', [AccountTrasectionController::class, 'cashpaymentvoucher'])->name('admin.transection.cpv.create');
Route::get('admin/account/transectionhead/bpv/create', [AccountTrasectionController::class, 'bankpaymentvoucher'])->name('admin.transection.bpv.create');
Route::get('admin/account/transectionhead/ftv/create', [AccountTrasectionController::class, 'foundtransfervoucher'])->name('admin.transection.ftv.create');
Route::get('admin/account/transectionhead/crv/create', [AccountTrasectionController::class, 'cashreceiptvoucher'])->name('admin.transection.crv.create');
Route::get('admin/account/transectionhead/brv/create', [AccountTrasectionController::class, 'bankreceiptvoucher'])->name('admin.transection.brv.create');
Route::get('admin/account/transectionhead/acrjv/create', [AccountTrasectionController::class, 'aorcreceablevoucher'])->name('admin.transection.acrjv.create');
Route::get('admin/account/transectionhead/acpv/create', [AccountTrasectionController::class, 'aorcpayblevoucher'])->name('admin.transection.acpv.create');
Route::get('admin/account/transectionhead/adpv/create', [AccountTrasectionController::class, 'adjustmentpayblevoucher'])->name('admin.transection.adpv.create');
Route::get('admin/account/transectionhead/aopv/create', [AccountTrasectionController::class, 'accountopeningvoucher'])->name('admin.transection.aopv.create');



// checkbook controller
Route::get('admin/checkbook/create', [CheckBookController::class, 'create'])->name('admin.checkbook.create');
Route::get('/get/account/checkbook/entry/{bank_code}', [CheckBookController::class, 'getallcheckentry']);
Route::get('admin/account/checktransectiondetails/insert', [CheckBookController::class, 'chekcbooktransectioninsert'])->name('account.checktransectiondetails.insert');
Route::get('admin/account/checktransectiondetails/show', [CheckBookController::class, 'chekcbooktransectionshow'])->name('account.checktransectiondetails.showitem');

Route::get('/get/account/status/bankentry/all/{bank_code}', [CheckBookController::class, 'getbankallstatus']);

Route::get('/get/account/showallstatus/bankentry/{status_show_book_id}', [CheckBookController::class, 'getshowstatusdata']);


Route::get('/get/admin/sourchofaccount/all/{account_head}', [AccountTrasectionController::class, 'getsourchaccount']);

Route::get('/get/admin/headofaccount/all/{account_head}', [AccountTrasectionController::class, 'getsaccheadaccount']);
Route::get('/get/admin/vouchertype/voucherno/all/{voucher_type}', [AccountTrasectionController::class, 'getvouchertype']);
Route::get('/get/admin/vouchertype/open/voucher/{invoice}', [AccountTrasectionController::class, 'openvoichertype']);
Route::get('/get/admin/accounthead/checkbok/all/{account_head}', [AccountTrasectionController::class, 'getcheckbookall']);

// reports controller
Route::get('admin/account/transection/reports/datewise', [ReportsController::class, 'datewisereport'])->name('admin.account.reports.datewise');
Route::post('admin/account/transection/reports/datewise', [ReportsController::class, 'datewisereportsearch'])->name('admin.account.reports.datewise');

Route::get('admin/account/transection/reports/vouchertypewise', [ReportsController::class, 'vouchertypewise'])->name('admin.account.reports.vouchertypewise');
Route::post('admin/account/transection/reports/vouchertypewise', [ReportsController::class, 'vouchertypewisesearch'])->name('admin.account.reports.vouchertypewise');


Route::get('admin/account/transection/reports/date', [ReportsController::class, 'onlydate'])->name('admin.account.reports.onlydatewise');
Route::post('admin/account/transection/reports/date', [ReportsController::class, 'onlydatesearch'])->name('admin.account.reports.onlydatewise');

Route::get('admin/account/transection/reports/employee', [ReportsController::class, 'employeereports'])->name('admin.account.reports.employee');
Route::post('admin/account/transection/reports/employee', [ReportsController::class, 'employeereportsearch'])->name('admin.account.reports.employee');

Route::get('admin/account/transection/reports/supplier', [ReportsController::class, 'supllierreprt'])->name('admin.account.reports.supplier');
Route::post('admin/account/transection/reports/supplier', [ReportsController::class, 'supllierreprtsearch'])->name('admin.account.reports.supplier');

Route::get('admin/account/transection/reports/guest', [ReportsController::class, 'guestreports'])->name('admin.account.reports.guests');
Route::post('admin/account/transection/reports/guest', [ReportsController::class, 'guestreportssearch'])->name('admin.account.reports.guests');



Route::get('admin/account/transection/reports/accounttransection', [ReportsController::class, 'accounttrasectionledger'])->name('admin.account.reports.accounttransection');
Route::post('admin/account/transection/reports/accounttransection', [ReportsController::class, 'accounttrasectionledgersearch'])->name('admin.account.reports.accounttransection');

Route::get('admin/account/transection/reports/cashbank', [ReportsController::class, 'cashandbankreports'])->name('admin.account.reports.cashbank');
Route::post('admin/account/transection/reports/cashbank', [ReportsController::class, 'cashandbankreportssearch'])->name('admin.account.reports.cashbank');

Route::get('/get/admin/source_account/current/blance/{source_account}', [AccountTrasectionController::class, 'getsourchaccountBalance']);
Route::get('/get/admin/head_account/current/blance/{head_account}', [AccountTrasectionController::class, 'getheadaccountBalance']);

Route::get('admin/account/transection/reports/usertransection', [ReportsController::class, 'userTransection'])->name('admin.account.reports.userTransection');
Route::post('admin/account/transection/reports/usertransection', [ReportsController::class, 'userTransectionsearch'])->name('admin.account.reports.userTransection');

Route::get('admin/account/transection/reports/uservoucher', [ReportsController::class, 'uservouchetypewise'])->name('admin.account.reports.uservouchertype');
Route::post('admin/account/transection/reports/uservoucher', [ReportsController::class, 'uservouchetypewisesearch'])->name('admin.account.reports.uservouchertype');

Route::get('admin/account/transection/demo', [ReportsController::class, 'demo']);
Route::get('admin/account/transection/voucherlist', [ReportsController::class, 'voucherlist'])->name('admin.account.reports.voucherlist');
Route::post('admin/account/transection/voucherlist', [ReportsController::class, 'voucherlistsearch'])->name('admin.account.reports.voucherlist');

Route::get('admin/account/transection/receiprpayment', [ReportsController::class, 'accountreceiptandpayment'])->name('admin.account.reports.accountreceiptandpayment');
Route::post('admin/account/transection/receiprpayment', [ReportsController::class, 'accountreceiptandpaymentsearch'])->name('admin.account.reports.accountreceiptandpayment');

Route::get('admin/account/transection/cashandbankdeatils', [ReportsController::class, 'cashandbankdetails'])->name('admin.account.reports.cashandbankdetails');
Route::post('admin/account/transection/cashandbankdeatils', [ReportsController::class, 'cashandbankdetailssearch'])->name('admin.account.reports.cashandbankdetails');

Route::get('admin/account/transection/finalreport', [ReportsController::class, 'finalreport'])->name('admin.account.reports.finalreport');
Route::post('admin/account/transection/finalreport', [ReportsController::class, 'finalreportsearch'])->name('admin.account.reports.finalreport');

