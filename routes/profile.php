<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {

    /* =========================
     | PROFILE
     ========================= */
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    /* =========================
     | PASSWORD
     ========================= */
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])
        ->name('password.edit');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    /* =========================
     | PHOTO
     ========================= */
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.photo.update');

    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])
        ->name('profile.photo.destroy');

    /* =========================
     | DELETE ACCOUNT
     ========================= */
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
