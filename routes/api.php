<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
// use App\http\contollers\AuthController;
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

Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth:sacntum']); 
    
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'updateprofile']);
    
    Route::put('tasks', [TaskController::class, 'update']);
    Route::post('assign-tasks/{employee}', [TaskController::class, 'assignTasks']);
    Route::resource('tasks', TaskController::class);
    
    Route::resource('reports', ReportController::class);
    
    Route::put('users', [UserController::class, 'update']);
    Route::resource('users', UserController::class);
    
    Route::put('roles', [RoleController::class, 'update']);
    Route::resource('roles', RoleController::class);
});

