<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
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
Route::post('/sendMessage', [HomeController::class, 'ContactSend']);
Route::get('/courses', [CourseController::class, 'coursePage']);
Route::get('/projects', [ProjectController::class, 'projectPage']);
Route::get('/blog', [BlogController::class, 'blogPage']);
Route::get('/contact', [ContactController::class, 'contactPage']);
Route::get('/terms', [TermsController::class, 'termsPage']);
Route::get('/privacy', [PrivacyController::class, 'privacyPage']);
