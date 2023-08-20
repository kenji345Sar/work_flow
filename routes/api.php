<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', [ApiController::class, 'showCurrentAuthenticatedUser']);
    Route::get('user/projects', [ProjectController::class, 'getUserProjects']);
    Route::get('user/tasks', [TaskController::class, 'getUserTasks']);

    Route::get('user/{id}', [ApiController::class, 'show']);


    Route::resource('projects', ProjectController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::post('/projects/{projectId}/tasks', [TaskController::class, 'store']);

    // ProjectUserテーブルのエンドポイント
    Route::prefix('project-users')->group(function () {
        Route::post('/', [ProjectUserController::class, 'store']);
        Route::get('/{id}', [ProjectUserController::class, 'show']);
        Route::delete('/{id}', [ProjectUserController::class, 'destroy']);
    });

    // Tasksテーブルのエンドポイント
    Route::prefix('tasks')->group(function () {
        Route::post('/', [TaskController::class, 'store']);
        Route::get('/{id}', [TaskController::class, 'show']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::delete('/{id}', [TaskController::class, 'destroy']);
    });
});
