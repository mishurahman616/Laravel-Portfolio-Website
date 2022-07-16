<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'HomeIndex']);

Route::get('/visitors', [VisitorController::class, 'visitorIndex']);
Route::get('/services', [ServiceController::class, 'serviceIndex']);
Route::get('/getServiceData', [ServiceController::class, 'getServiceData']);
Route::post('/getServiceDataById', [ServiceController::class, 'getServiceDataById']);
Route::post('/deleteService', [ServiceController::class, 'deleteService']);
Route::post('/updateService', [ServiceController::class, 'updateService']);
Route::post('/addService', [ServiceController::class, 'addService']);
