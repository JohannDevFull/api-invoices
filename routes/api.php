<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiSystem\UserController;
use App\Http\Controllers\InvoicesSystem\InvoiceController;
use App\Http\Controllers\InvoicesSystem\InvoicesSalesController;

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

Route::post('register',     [UserController::class, 'register']);
Route::post('login',        [UserController::class, 'authenticate']); 
Route::get('get-user-auth', [UserController::class, 'getAuthenticatedUser']);
Route::post('logout-api',    [UserController::class, 'logout']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::apiResource('invoices',          InvoicesController::class);
    Route::apiResource('invoices-sales',    InvoicesSalesController::class);
    Route::post('invoices-sales-pagination',[InvoicesSalesController::class, 'pagination']);
    Route::get('provider/{id}',             [InvoicesSalesController::class, 'getProvider']);

    Route::post('test',                     [InvoiceController::class, 'test']);

 });