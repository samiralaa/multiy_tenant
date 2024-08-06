<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/sales', \App\Http\Controllers\SalesReportController::class);
Route::apiResource('/inventory', \App\Http\Controllers\InventoryReportController::class);
Route::apiResource('/users', \App\Http\Controllers\Api\UserController::class);