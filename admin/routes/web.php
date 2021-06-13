<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectsController;


Route::get('/', [HomeController::class, 'HomeIndex']);

Route::get('/visitor', [VisitorController::class, 'VisitorIndex']);




//Admin panel Service Management
Route::get('/service', [ServiceController::class, 'ServiceIndex']);

Route::get('/getServicesData', [ServiceController::class, 'getServiceData']);

Route::post('/ServiceDelete', [ServiceController::class, 'ServiceDelete']);

Route::post('/ServiceDetails', [ServiceController::class, 'getServiceDetails']);

Route::post('/ServiceUpdate', [ServiceController::class, 'ServiceUpdate']);

Route::post('/ServiceAdd', [ServiceController::class, 'ServiceAdd']);




//Admin panel Courses management
Route::get('/courses', [CoursesController::class, 'CoursesIndex']);

Route::get('/getCoursesData', [CoursesController::class, 'getCoursesData']);

Route::post('/CoursesDelete', [CoursesController::class, 'CoursesDelete']);

Route::post('/CoursesDetails', [CoursesController::class, 'getCoursesDetails']);

Route::post('/CoursesUpdate', [CoursesController::class, 'CoursesUpdate']);

Route::post('/CoursesAdd', [CoursesController::class, 'CoursesAdd']);



//Admin panel Projects management
Route::get('/projects', [ProjectsController::class, 'ProjectIndex']);

Route::get('/getProjectsData', [ProjectsController::class, 'getProjectsData']);

Route::post('/ProjectDelete', [ProjectsController::class, 'ProjectDelete']);

Route::post('/ProjectDetails', [ProjectsController::class, 'getProjectDetails']);

Route::post('/ProjectUpdate', [ProjectsController::class, 'ProjectUpdate']);

Route::post('/ProjectAdd', [ProjectsController::class, 'ProjectAdd']);