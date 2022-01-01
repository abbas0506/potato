<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AcctController;


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
    Route::resource('clients', ClientController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('transporters', TransporterController::class);
    Route::resource('configs', ConfigController::class);
    Route::get('admin/signout', [UserController::class, 'signout']);
});
Route::group(['middleware' => 'user'], function () {
    Route::view('user', 'user.index');
    Route::resource('accounts', AcctController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('deals', DealController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('storage', StorageController::class);
    Route::resource('wastes', WasteController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('sell/fromfield/{id}', [PurchaseController::class, 'sellfromfield_create']);
    Route::get('sell/fromstore/{id}', [PurchaseController::class, 'sellfromstore_create']);
    Route::get('purchases/store/{id}', [PurchaseController::class, 'storage_create']);
    Route::get('wastes/create/{sid}/{pid}', [StorageController::class, 'wastes_create']);
    Route::get('print/seller/report', [DealController::class, 'print_seller_report']);



    Route::get('user/signout', [UserController::class, 'signout']);
});