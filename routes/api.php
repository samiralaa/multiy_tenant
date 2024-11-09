<?php

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Contact\ContactController;
use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\RequestPrice\RequestPriceController;
use App\Http\Controllers\Api\Setting\SocialMediaController;
use App\Http\Controllers\Api\Setting\SocialMediaLinksController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Marketing\Project;
use App\Models\SocialMedia;
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
    Route::post('/category/{id}', [\App\Http\Controllers\Api\Category\CategoryController::class, 'update']);
    Route::delete('/category/{id}', [\App\Http\Controllers\Api\Category\CategoryController::class, 'destroy']);
});

Route::middleware('setactivestore')->group(function () {

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index');
        Route::post('/projects', 'store');
        Route::get('/projects/{id}', 'show');
        Route::post('/projects/{id}', 'update');
        Route::delete('/projects/{id}', 'destroy');
    });

    Route::controller(SocialMediaController::class)->group(function () {
        Route::get('/social-media', 'index');
        Route::post('/social-media', 'store');
        Route::get('/social-media/{id}', 'show');
        Route::post('/social-media/{id}', 'update');
        Route::delete('/social-media/{id}', 'destroy');
    });

    Route::controller(SocialMediaLinksController::class)->group(function () {
        Route::get('/social-media-links', 'index');
        Route::post('/social-media-links', 'store');
        Route::get('/social-media-links/{id}', 'show');
        Route::post('/social-media-links/{id}', 'update');
        Route::delete('/social-media-links/{id}', 'destroy');
    });

    Route::controller(RequestPriceController::class)->group(function () {
        Route::get('/request-price', 'index');
        Route::post('/request-price', 'store');
        Route::get('/request-price/{id}', 'show');
        Route::post('/request-price/{id}', 'update');
        Route::delete('/request-price/{id}', 'destroy');
    });
});
