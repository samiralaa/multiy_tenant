<?php

use App\Http\Controllers\Api\Setting\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::get('/settings', [SocialMediaController::class, 'index'])->name('settings');
Route::post('/settings', [SocialMediaController::class, 'update'])->name('settings.update');
