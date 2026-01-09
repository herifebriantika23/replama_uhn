<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Jika sudah terverifikasi
        if ($user->hasVerifiedEmail()) {
            return $this->redirectByRole($user);
        }

        // Tandai email terverifikasi
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectByRole($user);
    }

    /**
     * Redirect sesuai role user
     */
    protected function redirectByRole($user): RedirectResponse
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('verified', 1);
        }

        if ($user->role === 'user') {
            // User MAHASISWA → diarahkan ke beranda user
            return redirect()->route('user.beranda')->with('verified', 1);
        }

        // Jika role tidak dikenal
        Auth::logout();

        return redirect()
            ->route('login')
            ->with('status', 'Role pengguna tidak valid.');
    }
}


