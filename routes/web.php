<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScrutinyController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PrintController;
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
    Route::view('admin', 'admin.index');
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::get('signout', [UserController::class, 'signout'])->name('signout');
});
Route::group(['middleware' => 'user'], function () {
    Route::view('user', 'user.index');
    // Route::resource('products', ProductController::class);
    // Route::resource('clients', ClientController::class);
    Route::get('signout', [UserController::class, 'signout'])->name('signout');
});