<?php

use App\Http\Controllers\Api\Setting\SocialMediaController;
use App\Http\Controllers\Api\Setting\SocialMediaLinksController;
use Illuminate\Support\Facades\Route;




Route::middleware('setactivestore')->group(function () {
  
    Route::controller(SocialMediaController::class)->group(function () {
        Route::get('/social-media', 'index');
        Route::post('/social-media', 'store');
        Route::get('/social-media/{id}','show');
        Route::post('/social-media/{id}', 'update');
        Route::delete('/social-media/{id}', 'destroy');
    });

    Route::controller(SocialMediaLinksController::class)->group(function () {
        Route::get('/social-media-links', 'index');
        Route::post('/social-media-links','store');
        Route::get('/social-media-links/{id}','show');
        Route::post('/social-media-links/{id}', 'update');
        Route::delete('/social-media-links/{id}', 'destroy');
    });
    
});
