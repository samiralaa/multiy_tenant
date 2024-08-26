<?php

use App\Http\Controllers\Api\Contact\ContactController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/users', [RegisteredUserController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index']);
    Route::get('/users/{id}', [RegisteredUserController::class, 'show']);

    Route::put('/users/{id}', [RegisteredUserController::class, 'update']);
    Route::delete('/users/{id}', [RegisteredUserController::class, 'destroy']);
});
Route::get('/users', [RegisteredUserController::class, 'index']);
Route::middleware('setactivestore')->group(function () {
    // Auth Users 
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register-user', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //contact 
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/contact/{id}', [ContactController::class, 'show']);
    Route::delete('/contact/{id}', [ContactController::class, 'destroy']);
    Route::put('/contact/{id}', [ContactController::class, 'update']);

    // category
    Route::get('/category', [\App\Http\Controllers\Api\Category\CategoryController::class, 'index']);
    Route::post('/category', [\App\Http\Controllers\Api\Category\CategoryController::class, 'store']);
    Route::get('/category/{id}', [\App\Http\Controllers\Api\Category\CategoryController::class, 'show']);
    Route::put('/category/{id}', [\App\Http\Controllers\Api\Category\CategoryController::class, 'update']);
    Route::delete('/category/{id}', [\App\Http\Controllers\Api\Category\CategoryController::class, 'destroy']);
});
