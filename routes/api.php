<?php

use App\Http\Controllers\App_AccController;
use App\Http\Controllers\App_InfoController;
use App\Http\Controllers\Emp_AccController;
use App\Http\Controllers\Auth1Controller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Emp_InfoController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RequestController;
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
Route::post('/login', [Auth1Controller::class, 'login']);  //user
Route::post('/login2', [Auth1Controller::class, 'login2']); //admin

Route::post('/register', [App_AccController::class,   'store']);
Route::post('/register2', [Emp_AccController::class,   'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [Auth1Controller::class,   'logout']);

    Route::controller(App_AccController::class)->group(function () {
        Route::get('/Applicant_Acc',         'index');
        Route::get('/Applicant_Acc/{id}',    'show');
    });

    Route::controller(Emp_AccController::class)->group(function () {
        Route::get('/Employer_Acc',         'index');
        Route::get('/Employer_Acc/{id}',    'show');
    });

    Route::controller(App_InfoController::class)->group(function () {
        Route::get('/info',         'index');
        Route::get('/info/{id}',    'show');
        Route::post('/info',         'store');
    });

    Route::controller(Emp_InfoController::class)->group(function () {
        Route::get('/Emp_Info',         'index');
        Route::get('/Emp_Info/{id}',    'show');
        Route::post('/Emp_Info',         'store');
    });

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/Department',         'index');
        Route::get('/Department/{id}',    'show');
        Route::post('/Department',        'store');
        Route::put('/Department/{id}',    'update');
        Route::delete('/Department/{id}', 'destroy');
    });

    Route::controller(JobController::class)->group(function () {
        Route::get('/job',         'index');
        Route::get('/job/{id}',    'show');
        Route::post('/job',        'store');
        Route::put('/job/{id}',    'update');
        Route::delete('/job/{id}', 'destroy');
    });

    Route::controller(RequestController::class)->group(function () {
        Route::get('/rapp',         'index');
        Route::get('/rappP',       'showAllP');
        Route::get('/rappA',       'showAllA');
        Route::get('/rappR',       'showAllR');
        Route::get('/rapp/{id}',    'show');
        Route::post('/rapp',        'store')->name('rapp.store');
        Route::put('/rapp/{id}',    'update')->name('rapp.update');
        Route::delete('/rapp/{id}', 'destroy');
    });
    
});


