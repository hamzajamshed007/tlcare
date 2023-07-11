<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('Registration',[UserController::class,'Registration']);
Route::post('OTPVerification',[UserController::class,'OTPVerification']);
Route::post('Login',[UserController::class,'Login']);
Route::post('UserOrBabySitterDetail',[UserController::class,'UserOrBabySitterDetail']);
Route::post('UserDetail',[UserController::class,'UserDetail']);
Route::post('BabySitterDetail',[UserController::class,'BabySitterDetail']);
Route::post('SocialLogin',[UserController::class,'SocialLogin']);

Route::group(['middleware'=>'auth:api'],function(){
    Route::post('AddService',[ServiceController::class,'AddService']);
    Route::post('GetAllServices',[ServiceController::class,'GetAllServices']);
    Route::post('ApplyOnService',[ServiceController::class,'ApplyOnService']);
    Route::post('GetAllApplicantsForUserJob',[ServiceController::class,'GetAllApplicantsForUserJob']);
    Route::post('ServiceAssignToBabySitter',[ServiceController::class,'ServiceAssignToBabySitter']);
    Route::post('UpdateUserDetail',[UserController::class,'UpdateUserDetail']);
    Route::post('UpdateBabySitterDetail',[UserController::class,'UpdateBabySitterDetail']);
    Route::post('OngoingService',[ServiceController::class,'OngoingService']);


});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware'=>['auth:sanctum']], function () {

// });