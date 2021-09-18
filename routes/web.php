<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserGroupsController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\ProductsController;
use \App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsStockController;
use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\Reports\DailyReportController;
use App\Http\Controllers\Reports\PaymentReportController;
use App\Http\Controllers\Reports\PurchaseReportController as ReportsPurchaseReportController;
use App\Http\Controllers\Reports\ReceiptReportController;
use App\Http\Controllers\Reports\SallesReportController;
use \App\Http\Controllers\UsersSalesController;
use \App\Http\Controllers\UserPurchasesController;
use \App\Http\Controllers\UserPaymentsController;
use \App\Http\Controllers\UserReceiptsController;
use App\Http\Controllers\UserReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('login', [LoginController::class, 'login'] )->name('login');
    Route::post('login', [LoginController::class, 'authenticate'] )->name('login.confirm');
    Route::get('logout', [LoginController::class, 'logout'] )->name('logout');

    Route::group(['middleware' => 'auth'],function (){

   
    //Route for Dashboard
    Route::get('/',            [DashboardController::class, 'index'] )->name('dashboard');
    Route::get('deshboard',            [DashboardController::class, 'index'] )->name('dashboard');


    //Route for Groups
    Route::get('groups',            [UserGroupsController::class, 'index'] );
    Route::get('groups/create',     [UserGroupsController::class, 'create'] );
    Route::post('groups',           [UserGroupsController::class, 'store'] );
    Route::delete('groups/{id}',    [UserGroupsController::class, 'destroy'] );


    Route::resource('users', UsersController::class);


    //Route For Sale
    Route::get('users/{id}/sales',                              [UsersSalesController::class,'index'])->name('user.sales');
    Route::post('users/{id}/invoices',                          [UsersSalesController::class,'createInvoice'])->name('user.sales.store');
    Route::delete('users/{id}/invoices/{invoice_id}',           [UsersSalesController::class,'destroy'])->name('user.sales.delete');
    Route::get('users/{id}/invoices/{invoice_id}',              [UsersSalesController::class,'invoice'])->name('user.sales.invoice_details');
    Route::post('users/{id}/invoices/{invoice_id}',             [UsersSalesController::class,'addItem'])->name('user.sales.invoice.add_item');
    Route::delete('users/{id}/invoices/{invoice_id}/{item_id}', [UsersSalesController::class,'destroyItem'])->name('user.sales.invoice.delete_item');


    //Route For Purchase
    Route::get('users/{id}/purchases',                          [UserPurchasesController::class,'index'])->name('user.purchases');
    Route::post('users/{id}/purchase',                          [UserPurchasesController::class,'createInvoice'])->name('user.purchase.store');
    Route::delete('users/{id}/purchase/{invoice_id}',           [UserPurchasesController::class,'destroy'])->name('user.purchase.delete');
    Route::get('users/{id}/purchase/{invoice_id}',              [UserPurchasesController::class,'invoice'])->name('user.purchase.invoice_details');
    Route::post('users/{id}/purchase/{invoice_id}',             [UserPurchasesController::class,'addItem'])->name('user.purchase.add_item');
    Route::delete('users/{id}/purchase/{invoice_id}/{item_id}', [UserPurchasesController::class,'destroyItem'])->name('user.purchase.delete_item');


    //Route For Payment
    Route::get('users/{id}/payments',                   [UserPaymentsController::class,'index'])->name('user.payments');
    Route::post('users/{id}/payments/{invoice_id?}',    [UserPaymentsController::class,'store'])->name('user.payments.store');
    Route::delete('users/{id}/payments/{payment_id}',   [UserPaymentsController::class,'destroy'])->name('user.payments.destroy');


    //Route For Receipt
    Route::get('users/{id}/receipts',                   [UserReceiptsController::class,'index'])->name('user.receipts');
    Route::post('users/{id}/receipts/{invoice_id?}',    [UserReceiptsController::class,'store'])->name('user.receipts.store');
    Route::delete('users/{id}/receipts/{receipt_id}',   [UserReceiptsController::class,'destroy'])->name('user.receipts.destroy');


    Route::get('users/{id}/reports',                    [UserReportController::class,'reports'])->name('user.reports');


    //Route For Categories
    Route::resource('categories', CategoriesController::class, ['except' => 'show']);


    //Route For Products
    Route::resource('products', ProductsController::class);

    Route::get('stocks', [ProductsStockController::class, 'index'])->name('stocks');


    //Route for Reports
    Route::get('reports/sales',     [SallesReportController::class, 'index'])->name('reports.sales');
    Route::get('reports/purchase',  [ReportsPurchaseReportController::class, 'index'])->name('reports.purchase');
    Route::get('reports/payment',   [PaymentReportController::class, 'index'])->name('reports.payment');
    Route::get('reports/receipt',   [ReceiptReportController::class, 'index'])->name('reports.receipt');


    Route::get('reports/daily',   [DailyReportController::class, 'index'])->name('reports.daily');

});









