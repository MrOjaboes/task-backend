<?php

use App\Http\Controllers\InviteesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('account')->group(function () {
    Route::post('sign-up', [App\Http\Controllers\API\AccountController::class, 'signUp']);
    Route::post('/sign-in', [App\Http\Controllers\API\AccountController::class, 'login']);
    Route::post('/sign-out', [App\Http\Controllers\API\AccountController::class, 'logout'])->middleware(['auth:sanctum']);
    });
Route::prefix('task')->group(function () {
    Route::post('create', [App\Http\Controllers\API\TaskController::class, 'store']);
    Route::get('/', [App\Http\Controllers\API\TaskController::class, 'index']);
    Route::get('edit/{id}', [App\Http\Controllers\API\TaskController::class, 'show']);
    Route::put('update/{id}', [App\Http\Controllers\API\TaskController::class, 'update']);
    Route::delete('delete/{id}', [App\Http\Controllers\API\TaskController::class, 'destroy']);
});

