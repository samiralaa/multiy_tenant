<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

                
    Route::post('register', [RegisteredUserController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('password/reset', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('password/email', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');
Route::get('password/reset/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('password/reset', [NewPasswordController::class, 'store'])
                ->name('password.update');

    Route::get('email/verify', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

    Route::get('password/confirm', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
Route::post('password/confirm', [ConfirmablePasswordController::class, 'confirm'])
                ->name('password.confirm');

    Route::get('password/confirm/{token}', [ConfirmablePasswordController::class, 'confirmWithToken'])
                ->name('password.confirm.token');

    Route::get('profile', function () {
        
    })->name('profile.show');
});