<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PeriodeMagangController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\NotificationController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /**
         * =========================
         * DASHBOARD
         * =========================
         */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /**
         * =========================
         * NOTIFICATIONS
         * =========================
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

        /**
         * =========================
         * MASTER DATA
         * =========================
         */
        Route::resource('fakultas', FakultasController::class)
            ->except(['create', 'show']);

        Route::resource('prodi', ProdiController::class)
            ->except(['create', 'show']);

        Route::resource('mahasiswa', UserController::class)
            ->except(['create', 'store', 'show']);

        /**
         * =========================
         * LAPORAN (MODAL ONLY)
         * =========================
         */
        Route::resource('laporan', LaporanController::class)
            ->only(['index', 'update', 'destroy']);

        /**
         * =========================
         * PERIODE MAGANG
         * =========================
         */
        Route::resource('periode', PeriodeMagangController::class)
            ->except(['create', 'edit', 'show']);

        /**
         * =========================
         * STATISTIK
         * =========================
         */
        Route::get('/statistik', [StatistikController::class, 'index'])
            ->name('statistik.index');
    });


