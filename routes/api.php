<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;

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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('user/{id}', [ApiController::class, 'show']);

Route::post('register', [RegisteredUserController::class, 'store']);

// projectsテーブルのエンドポイント
// Route::prefix('projects')->group(function () {
//     Route::post('/', [ProjectController::class, 'store']); // 登録
//     Route::get('/{id}', [ProjectController::class, 'show']); // 表示
//     Route::put('/{id}', [ProjectController::class, 'update']); // 編集
//     Route::delete('/{id}', [ProjectController::class, 'destroy']); // 削除
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('projects', ProjectController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);
});

Route::post('/login', [AuthController::class, 'login']);


// ProjectUserテーブルのエンドポイント
Route::prefix('project-users')->group(function () {
    Route::post('/', [ProjectUserController::class, 'store']); // 登録
    Route::get('/{id}', [ProjectUserController::class, 'show']); // 表示
    Route::delete('/{id}', [ProjectUserController::class, 'destroy']); // 削除
});

// Tasksテーブルのエンドポイント
Route::prefix('tasks')->group(function () {
    Route::post('/', [TaskController::class, 'store']); // 登録
    Route::get('/{id}', [TaskController::class, 'show']); // 表示
    Route::put('/{id}', [TaskController::class, 'update']); // 編集
    Route::delete('/{id}', [TaskController::class, 'destroy']); // 削除
});
