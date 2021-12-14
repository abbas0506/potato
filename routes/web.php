<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\DealController;



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
    Route::get('admin/signout', [UserController::class, 'signout']);
});
Route::group(['middleware' => 'user'], function () {
    Route::view('user', 'user.index');
    Route::resource('purchases', PurchaseController::class);
    Route::resource('deals', DealController::class);
    // Route::resource('sales', SaleController::class);

    Route::get('purchases/sell/{id}', [PurchaseController::class, 'get_sell']);
    Route::post('purchases/sell/{id}', [PurchaseController::class, 'post_sell']);
    Route::get('purchases/store/{id}', [PurchaseController::class, 'viewStorage']);
    Route::post('purchases/store/{id}', [PurchaseController::class, 'postStorage']);

    Route::get('user/signout', [UserController::class, 'signout']);
});