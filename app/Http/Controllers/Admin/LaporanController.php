<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\LaporanNotification;

class LaporanController extends Controller
{
    /**
     * =========================
     * DAFTAR LAPORAN (MODAL)
     * =========================
     */
    public function index()
    {
        $laporan = Laporan::with([
                'user',
                'prodi.fakultas',
                'periodeMagang',
            ])
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('laporan'));
    }

    /**
     * =========================
     * UPDATE STATUS (VERIFIKASI)
     * DIPANGGIL DARI MODAL
     * =========================
     */
    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'status'  => 'required|in:menunggu,disetujui,revisi',
            'catatan' => 'nullable|required_if:status,revisi|string|max:1000',
        ]);

        $laporan->update([
            'status'  => $validated['status'],
            'catatan' => $validated['status'] === 'revisi'
                ? $validated['catatan']
                : null,
        ]);

        // NOTIFIKASI KE USER
        if ($laporan->user) {
            $laporan->user->notify(
                new LaporanNotification($laporan)
            );
        }

        return back()->with(
            'success',
            'Status laporan berhasil diperbarui.'
        );
    }

    /**
     * =========================
     * HAPUS LAPORAN (ADMIN)
     * =========================
     */
    public function destroy(Laporan $laporan)
    {
        if (
            $laporan->file_pdf &&
            Storage::disk('public')->exists($laporan->file_pdf)
        ) {
            Storage::disk('public')->delete($laporan->file_pdf);
        }

        $laporan->delete();

        return back()->with(
            'success',
            'Laporan berhasil dihapus.'
        );
    }
}



