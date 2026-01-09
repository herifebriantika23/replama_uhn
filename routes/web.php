<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\GuideController;
use App\Http\Controllers\Guest\AboutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/guide', [GuideController::class, 'index'])->name('guide');

// ===== AUTHENTICATION =====
require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';


