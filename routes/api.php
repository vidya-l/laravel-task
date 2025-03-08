<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\TimesheetController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('login', [AuthController::class, 'login']);

Route::prefix('user')->middleware('auth:api')->group(function () {
    Route::get('/', [UserController::class, 'getAllUsers']);
    Route::get('/{id}', [UserController::class, 'getUserDetail']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);
});

Route::prefix('project')->middleware('auth:api')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::post('/', [ProjectController::class, 'create']);
    Route::get('/{project}', [ProjectController::class, 'getProjectDetail']);
    Route::put('/{project}', [ProjectController::class, 'update']);
    Route::delete('/{project}', [ProjectController::class, 'delete']);
});

Route::prefix('attribute')->middleware('auth:api')->group(function () {
    Route::get('/', [AttributeController::class, 'index']);
    Route::post('/', [AttributeController::class, 'create']);
    Route::get('/{attribute}', [AttributeController::class, 'getAttributeDetail']);
    Route::put('/{attribute}', [AttributeController::class, 'update']);
    Route::delete('/{attribute}', [AttributeController::class, 'delete']);
});

Route::prefix('timesheet')->middleware('auth:api')->group(function () {
    Route::get('/', [TimesheetController::class, 'index']);
    Route::post('/', [TimesheetController::class, 'create']);
    Route::get('/{timesheet}', [TimesheetController::class, 'getTimesheetDetail']);
    Route::put('/{timesheet}', [TimesheetController::class, 'update']);
    Route::delete('/{timesheet}', [TimesheetController::class, 'delete']);
});