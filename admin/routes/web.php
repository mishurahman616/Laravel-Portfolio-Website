<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['loginCheck'])->group(function () {
    Route::get('/', [HomeController::class, 'HomeIndex'])->middleware('loginCheck');

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

//Admin Project Controller
Route::get('/projects', [ProjectController::class, 'projectIndex']);
Route::get('/getProjectData', [ProjectController::class, 'getProjectData']);
Route::post('/getProjectDataById', [ProjectController::class, 'getProjectDataById']);
Route::post('/deleteProject', [ProjectController::class, 'deleteProject']);
Route::post('/updateProject', [ProjectController::class, 'updateProject']);
Route::post('/addProject', [ProjectController::class, 'addProject']);

//Admin Contact Controller
Route::get('/contacts', [ContactController::class, 'contactIndex']);
Route::post('/deleteContactById', [ContactController::class, 'deleteContactById']);

//Admin Review Controller
Route::get('/reviews', [ReviewController::class, 'reviewIndex']);
Route::get('/getReviewData', [ReviewController::class, 'getReviewData']);
Route::post('/getReviewDataById', [ReviewController::class, 'getReviewDataById']);
Route::post('/deleteReview', [ReviewController::class, 'deleteReview']);
Route::post('/updateReview', [ReviewController::class, 'updateReview']);
Route::post('/addReview', [ReviewController::class, 'addReview']);
Route::get('/logout', [LoginController::class, 'onLogout']);
});


Route::get('/login', [LoginController::class, 'loginIndex']);
Route::post('/loginRequest', [LoginController::class, 'onLogin']);