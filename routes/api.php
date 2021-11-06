<?php

use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::apiResource('employee', '\App\Http\Controllers\EmployeeController');
Route::apiResource('company', '\App\Http\Controllers\CompanyController')->except('update');


Route::post('company/update/{id}', [\App\Http\Controllers\CompanyController::class, 'update']);
Route::get('company-for-employee', [\App\Http\Controllers\CompanyController::class, 'getCompanyListForEmployee']);
