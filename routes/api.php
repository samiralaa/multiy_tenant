<?php

use App\Http\Controllers\Api\Category\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('setactivestore')->group(function () {
  
   Route::get('products',[\App\Http\Controllers\Web\ProductController::class,'index']);


});

Route::middleware('setactivestore')->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
 });
 