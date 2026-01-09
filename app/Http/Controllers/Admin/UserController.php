<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * ===============================
     * DAFTAR MAHASISWA
     * ===============================
     */
    public function index()
    {
        $users = User::with([
                'prodi.fakultas',
                'laporan'
            ])
            ->where('role', 'user')
            ->latest()
            ->get();

        return view('admin.mahasiswa.index', compact('users'));
    }

    /**
     * ===============================
     * UPDATE DATA MAHASISWA (MODAL)
     * ===============================
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nim'  => 'nullable|string|max:50|unique:users,nim,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'nim'  => $request->nim,
        ]);

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    /**
     * ===============================
     * HAPUS MAHASISWA + LAPORAN
     * ===============================
     */
    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {

            $user = User::where('role', 'user')
                ->with('laporan')
                ->findOrFail($id);

            foreach ($user->laporan as $laporan) {
                if (
                    $laporan->file_pdf &&
                    Storage::disk('public')->exists($laporan->file_pdf)
                ) {
                    Storage::disk('public')->delete($laporan->file_pdf);
                }

                $laporan->delete();
            }

            $user->delete();
        });

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa beserta seluruh laporannya berhasil dihapus');
    }
}

