<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api/v1
Route::prefix('v1')->group(function () {
    Route::apiResource('/customer',\App\Http\Controllers\Api\V1\CustomerController::class);
    Route::apiResource('/invoice',\App\Http\Controllers\Api\V1\InvoiceController::class);

    Route::post('/invoices/bulk',[\App\Http\Controllers\Api\V1\InvoiceController::class,'bulkStore']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',\App\Http\Controllers\User\LogoutController::class)->name('logout');


});

Route::post('register',\App\Http\Controllers\User\RegistrationController::class)->name('register');
Route::post('login',\App\Http\Controllers\User\LoginController::class)->name('login');
Route::get('login',\App\Http\Controllers\User\LoginController::class);


