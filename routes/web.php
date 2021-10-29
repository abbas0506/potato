<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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
Route::resource('home', HomeController::class)->only(['index']);
Route::resource('registration', RegistrationController::class);
Route::get("registrationfilter/{group_id}", [RegistrationController::class, 'registrationfilter']);

Route::resource('fee', FeeController::class);
Route::resource('scrutiny', ScrutinyController::class);
Route::get('scrutinize/{id}', [ScrutinyController::class, 'scrutinize']);

Route::post("payfee/{reg_id}", [FeeController::class, 'payfee']);
Route::get("showcancelfee", [FeeController::class, 'showcancelfee']);
Route::post("cancelfee/{reg_id}", [FeeController::class, 'cancelfee']);

Route::resource('print', PrintController::class)->only(['index']);
Route::post("preview", [PrintController::class, 'preview']);
Route::put("uploadimage/{registration}", [RegistrationController::class, 'uploadimage'])->name('uploadimage');
Route::view("assignclassrollno", "registrations.assignclassrollno");
Route::post("assignclassrollno", [RegistrationController::class, 'assignClassRollNo']);

Route::view("viewAutoEnroll", "registrations.autoEnroll");
Route::post("postAutoEnroll", [RegistrationController::class, 'postAutoEnroll']);

Route::get("viewAssignSection", [SectionController::class, 'viewAssignSection']);
Route::post("postAssignSection", [SectionController::class, 'postAssignSection']);
Route::get("viewDetachSection", [SectionController::class, 'viewDetachSection']);
Route::post("postDetachSection", [SectionController::class, 'postDetachSection']);
Route::post("postMoveSection", [SectionController::class, 'postMoveSection']);