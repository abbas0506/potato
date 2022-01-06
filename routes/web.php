<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BuyerpaymentController;
use App\Http\Controllers\SellerpaymentController;


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

Route::get('/', function () {
    return view('signin');
});
Route::post('signin', [UserController::class, 'signin']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin', [UserController::class, 'index'])->name('admin');
    Route::resource('products', ProductController::class);
    Route::resource('sellers', SellerController::class);
    Route::resource('buyers', BuyerController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('transporters', TransporterController::class);
    Route::resource('configs', ConfigController::class);
    Route::get('admin/signout', [UserController::class, 'signout']);
});
Route::group(['middleware' => 'user'], function () {
    Route::view('user', 'user.index');
    Route::resource('purchases', PurchaseController::class);
    Route::resource('deals', DealController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('storage', StorageController::class);
    Route::resource('wastes', WasteController::class);
    Route::view('payments', 'user.payments.index');

    Route::resource('sellerpayments', SellerpaymentController::class);
    Route::resource('buyerpayments', BuyerpaymentController::class);
    Route::get('buyerpayment/create/{id}', [BuyerpaymentController::class, 'create']);
    Route::get('sellerpayment/create/{id}', [SellerpaymentController::class, 'create']);

    Route::resource('reports', ReportController::class);

    Route::get('sell/fromfield/{id}', [PurchaseController::class, 'sellfromfield_create']);
    Route::get('sell/fromstore/{pid}/{sid}', [PurchaseController::class, 'sellfromstore_create']);
    Route::get('purchases/store/{id}', [PurchaseController::class, 'storage_create']);
    Route::get('wastes/create/{sid}/{pid}', [StorageController::class, 'wastes_create']);
    Route::post('fetchstorage', [StorageController::class, 'fetch']);

    Route::get('print/seller/report/{id}', [ReportController::class, 'print_seller_report']);
    Route::get('print/buyer/report/{id}', [ReportController::class, 'print_buyer_report']);



    Route::get('user/signout', [UserController::class, 'signout']);
});