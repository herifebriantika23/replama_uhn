<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LaporanNotification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bootstrap pagination
        Paginator::useBootstrap();

        /**
         * =========================
         * VIEW COMPOSER - ADMIN NAVBAR
         * =========================
         */
        View::composer('layouts.admin.*', function ($view) {

            // DEFAULT (ANTI ERROR)
            $view->with([
                'admin' => Auth::user(),
                'adminUnreadCount' => 0,
                'adminNotifications' => collect(),
            ]);

            if (Auth::check()) {

                /** @var \App\Models\User $admin */
                $admin = Auth::user();

                if ($admin->isAdmin()) {
                    $view->with([
                        'admin' => $admin,
                        'adminUnreadCount' => $admin->unreadNotifications()
                            ->where('type', LaporanNotification::class)
                            ->where('data->judul', 'Laporan Baru Masuk')
                            ->count(),

                        'adminNotifications' => $admin->notifications()
                            ->where('type', LaporanNotification::class)
                            ->where('data->judul', 'Laporan Baru Masuk')
                            ->latest()
                            ->take(5)
                            ->get(),
                    ]);
                }
            }
        });

        /**
         * =========================
         * VIEW COMPOSER - USER NAVBAR
         * =========================
         */
        View::composer('layouts.user.*', function ($view) {

            // DEFAULT (ANTI ERROR)
            $view->with([
                'navUser' => Auth::user(),
                'navUnreadCount' => 0,
                'navNotifications' => collect(),
            ]);

            if (Auth::check()) {

                /** @var \App\Models\User $user */
                $user = Auth::user();

                if ($user->isUser()) {
                    $view->with([
                        'navUser' => $user,
                        'navUnreadCount' => $user->unreadNotifications()->count(),
                        'navNotifications' => $user->notifications()
                            ->latest()
                            ->take(5)
                            ->get(),
                    ]);
                }
            }
        });
    }
}


