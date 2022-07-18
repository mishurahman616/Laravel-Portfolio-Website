<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
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

//Admin Service Controller
Route::get('/services', [ServiceController::class, 'serviceIndex']);
Route::get('/getServiceData', [ServiceController::class, 'getServiceData']);
Route::post('/getServiceDataById', [ServiceController::class, 'getServiceDataById']);
Route::post('/deleteService', [ServiceController::class, 'deleteService']);
Route::post('/updateService', [ServiceController::class, 'updateService']);
Route::post('/addService', [ServiceController::class, 'addService']);

//Admin Course Controller
Route::get('/courses', [CourseController::class, 'courseIndex']);
Route::get('/getCourseData', [CourseController::class, 'getCourseData']);
Route::post('/getCourseDataById', [CourseController::class, 'getCourseDataById']);
Route::post('/deleteCourse', [CourseController::class, 'deleteCourse']);
Route::post('/updateCourse', [CourseController::class, 'updateCourse']);
Route::post('/addCourse', [CourseController::class, 'addCourse']);