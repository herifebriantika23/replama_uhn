<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LaporanController;
use App\Http\Controllers\User\GuideController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\NotificationController;

Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        /**
         * =====================
         * HALAMAN USER
         * =====================
         */
        Route::get('/beranda', [HomeController::class, 'index'])
            ->name('beranda');

        Route::get('/panduan', [GuideController::class, 'index'])
            ->name('panduan');

        Route::get('/tentang', [AboutController::class, 'index'])
            ->name('tentang');

        /**
         * =====================
         * LAPORAN (MODAL)
         * =====================
         */
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::post('/laporan', [LaporanController::class, 'store'])
            ->name('laporan.store');

        Route::put('/laporan/{laporan}/revisi', [LaporanController::class, 'revisi'])
            ->name('laporan.revisi');

        Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])
            ->name('laporan.destroy');

        /**
         * =====================
         * NOTIFICATIONS
         * =====================
         */
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notification.index');

        // klik 1 notifikasi → read → redirect
        Route::get('/notifications/{id}/read', [NotificationController::class, 'read'])
            ->name('notification.read');

        Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])
            ->name('notification.readAll');

        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
            ->name('notification.destroy');
    });


