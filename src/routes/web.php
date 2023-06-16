<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TimestampsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;

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




Route::middleware('auth')->group(function () {
    Route::get('/', [LoginController::class, 'login']);

    Route::get('/start_worktime', [LoginController::class, 'login']);
    Route::post('/start_worktime', [TimestampsController::class, 'startWork']);
    Route::get('/end_worktime', [LoginController::class, 'login']);
    Route::post('/end_worktime', [TimestampsController::class, 'endWork']);
    
    Route::get('/start_breaktime', [LoginController::class, 'login']);
    Route::post('/start_breaktime', [TimestampsController::class, 'startBreak']);
    Route::get('/end_breaktime', [LoginController::class, 'login']);
    Route::post('/end_breaktime', [TimestampsController::class, 'endBreak']);

    Route::get('/attendance', [AttendanceController::class, 'attendanceView']);
    Route::get('/user', [UserController::class, 'userView']);
    });