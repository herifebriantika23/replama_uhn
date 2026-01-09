<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = $request->user();

        // Jika email sudah diverifikasi
        if ($user->hasVerifiedEmail()) {

            // ===== ADMIN =====
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // ===== USER / MAHASISWA =====
            if ($user->role === 'user') {
                // kembali ke beranda user setelah verifikasi
                return redirect()->route('user.beranda');
            }

            // ===== ROLE TIDAK DIKENAL =====
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Role pengguna tidak valid.']);
        }

        // Jika email BELUM diverifikasi
        return view('auth.verify-email');
    }
}


