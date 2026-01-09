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

        // Jika sudah terverifikasi sebelumnya
        if ($user->hasVerifiedEmail()) {
            return $this->redirectByRole($user);
        }

        // Tandai email terverifikasi dan kirim event
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectByRole($user);
    }

    /**
     * Redirect berdasarkan role user setelah verifikasi email.
     */
    protected function redirectByRole($user): RedirectResponse
    {
        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.dashboard')
                ->with('verified', true);
        }

        if ($user->role === 'user') {
            return redirect()
                ->route('user.beranda')
                ->with('verified', true);
        }

        // Jika role tidak diketahui
        Auth::logout();
        return redirect()
            ->route('login')
            ->with('status', 'Role tidak dikenali.');
    }
}
