<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\PeriodeMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\LaporanNotification;

class LaporanController extends Controller
{
    /**
     * =========================
     * LIST LAPORAN USER
     * (MODAL + DATATABLES)
     * =========================
     */
    public function index()
    {
        $laporan = Laporan::with([
                'user',
                'prodi.fakultas',
                'periodeMagang'
            ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $fakultas = Fakultas::orderBy('nama')->get();
        $prodis   = Prodi::orderBy('nama')->get();
        $periodes = PeriodeMagang::where('aktif', true)
                        ->orderBy('mulai')
                        ->get();

        return view('user.laporan.index', compact(
            'laporan',
            'fakultas',
            'prodis',
            'periodes'
        ));
    }

    /**
     * =========================
     * SIMPAN LAPORAN (MODAL)
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'              => 'required|string|max:255',
            'file_pdf'           => 'required|mimes:pdf|max:5120',
            'fakultas_id'        => 'required|exists:fakultas,id',
            'prodi_id'           => 'required|exists:prodis,id',
            'periode_magang_id'  => 'required|exists:periode_magangs,id',
            'dosen_pembimbing'   => 'required|string|max:255',
        ]);

        $path = $request->file('file_pdf')
                        ->store('laporan', 'public');

        $laporan = Laporan::create([
            'user_id'           => Auth::id(),
            'prodi_id'          => $request->prodi_id,
            'periode_magang_id' => $request->periode_magang_id,
            'dosen_pembimbing'  => $request->dosen_pembimbing,
            'judul'             => $request->judul,
            'file_pdf'          => $path,
            'status'            => 'menunggu',
        ]);

       
        // NOTIFIKASI ADMIN
            User::where('role', 'admin')->each(function ($admin) use ($laporan) {
                $admin->notify(
                    new LaporanNotification($laporan)
                );
            });


        return back()->with(
            'success',
            'Laporan berhasil diunggah dan menunggu verifikasi admin.'
        );
    }

    /**
     * =========================
     * REVISI LAPORAN (MODAL)
     * =========================
     */
    public function revisi(Request $request, Laporan $laporan)
    {
        // KEAMANAN
        abort_if($laporan->user_id !== Auth::id(), 403);
        abort_if($laporan->status !== 'revisi', 403);

        $request->validate([
            'file_pdf' => 'required|mimes:pdf|max:5120',
        ]);

        // HAPUS FILE LAMA
        if ($laporan->file_pdf) {
            Storage::disk('public')->delete($laporan->file_pdf);
        }

        $path = $request->file('file_pdf')
                        ->store('laporan', 'public');

        $laporan->update([
            'file_pdf' => $path,
            'status'   => 'menunggu',
            'catatan'  => null,
        ]);

        return back()->with(
            'success',
            'Revisi berhasil dikirim. Menunggu verifikasi ulang.'
        );
    }

    /**
     * =========================
     * HAPUS LAPORAN (MODAL)
     * =========================
     */
    public function destroy(Laporan $laporan)
    {
        abort_if($laporan->user_id !== Auth::id(), 403);

        if ($laporan->status === 'disetujui') {
            return back()->with(
                'error',
                'Laporan yang sudah disetujui tidak dapat dihapus.'
            );
        }

        if ($laporan->file_pdf) {
            Storage::disk('public')->delete($laporan->file_pdf);
        }

        $laporan->delete();

        return back()->with(
            'success',
            'Laporan berhasil dihapus.'
        );
    }
}


