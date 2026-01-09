<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * =========================
     * LIST NOTIFIKASI
     * =========================
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $notifications = $user->notifications()
            ->latest()
            ->paginate(10);

        return $user->role === 'admin'
            ? view('admin.notifications.index', compact('notifications'))
            : view('user.notifications.index', compact('notifications'));
    }

    /**
     * =========================
     * KLIK 1 NOTIFIKASI
     * → TANDAI DIBACA
     * → REDIRECT KE HALAMAN TUJUAN
     * =========================
     */
    public function read(string $id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $notification = $user->notifications()->findOrFail($id);

        // Tandai sebagai dibaca
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        // ===== ARAH REDIRECT (TANPA JS, TANPA MODAL) =====

        // ADMIN → halaman verifikasi laporan
        if ($user->role === 'admin') {
            return redirect()->route('admin.laporan.index');
        }

        // USER → halaman upload laporan
        return redirect()->route('user.laporan.index');
    }

    /**
     * =========================
     * TANDAI SEMUA DIBACA
     * =========================
     */
    public function readAll(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();

        return redirect()->route(
            $user->role === 'admin'
                ? 'admin.notification.index'
                : 'user.notification.index'
        )->with('success', 'Semua notifikasi ditandai sebagai dibaca');
    }

    /**
     * =========================
     * HAPUS 1 NOTIFIKASI
     * =========================
     */
    public function destroy(string $id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->notifications()
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus');
    }
}

