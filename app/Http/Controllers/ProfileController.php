<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * =========================
     * SHOW PROFILE
     * =========================
     */
    public function show(): View
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.profile.show', compact('user'));
        }

        return view('user.profile.show', compact('user'));
    }

    /**
     * =========================
     * EDIT PROFILE
     * =========================
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return view('admin.profile.edit', compact('user'));
        }

        $fakultas = Fakultas::orderBy('nama')->get();
        $prodis   = Prodi::with('fakultas')->orderBy('nama')->get();

        return view('user.profile.edit', compact(
            'user',
            'fakultas',
            'prodis'
        ));
    }

    /**
     * =========================
     * UPDATE PROFILE DATA
     * =========================
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * =========================
     * EDIT PASSWORD
     * =========================
     */
    public function editPassword(): View
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.profile.password', compact('user'));
        }

        return view('user.profile.password', compact('user'));
    }

    /**
     * =========================
     * UPDATE PASSWORD
     * =========================
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('password.edit')
            ->with('success', 'Password berhasil diperbarui');
    }

    /**
     * =========================
     * UPDATE PHOTO
     * =========================
     */
    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = $request->user();

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $path = $request->file('photo')->store('profile', 'public');

        $user->update([
            'photo' => $path,
        ]);

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }

    /**
     * =========================
     * DELETE PHOTO
     * =========================
     */
    public function destroyPhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->update(['photo' => null]);

        return back()->with('success', 'Foto profil berhasil dihapus');
    }

    /**
     * =========================
     * DELETE ACCOUNT
     * =========================
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')
            ->with('success', 'Akun berhasil dihapus');
    }
}



