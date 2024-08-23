<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('setactivestore')->group(function () {
  
    Route::get('products',[\App\Http\Controllers\Web\ProductController::class,'index']);
    Route::get('categories',[\App\Http\Controllers\Web\CatrgoryController::class,'index']);
});



