<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeMagang;
use Illuminate\Http\Request;

class PeriodeMagangController extends Controller
{
    /**
     * LIST PERIODE MAGANG
     */
    public function index()
    {
        $periodeMagang = PeriodeMagang::orderByDesc('mulai')->get();

        return view('admin.periode.index', compact('periodeMagang'));
    }

    /**
     * SIMPAN PERIODE BARU (MODAL)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'mulai'   => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
        ]);

        $aktif = $request->has('aktif');

        if ($aktif) {
            PeriodeMagang::where('aktif', true)->update(['aktif' => false]);
        }

        PeriodeMagang::create([
            'nama'    => $validated['nama'],
            'mulai'   => $validated['mulai'],
            'selesai' => $validated['selesai'],
            'aktif'   => $aktif,
        ]);

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Periode magang berhasil ditambahkan');
    }

    /**
     * UPDATE PERIODE (MODAL)
     */
    public function update(Request $request, string $id)
    {
        $periode = PeriodeMagang::findOrFail($id);

        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'mulai'   => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
        ]);

        $aktif = $request->has('aktif');

        if ($aktif) {
            PeriodeMagang::where('aktif', true)
                ->where('id', '!=', $periode->id)
                ->update(['aktif' => false]);
        }

        $periode->update([
            'nama'    => $validated['nama'],
            'mulai'   => $validated['mulai'],
            'selesai' => $validated['selesai'],
            'aktif'   => $aktif,
        ]);

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Periode magang berhasil diperbarui');
    }

    /**
     * HAPUS PERIODE
     */
    public function destroy(string $id)
    {
        PeriodeMagang::findOrFail($id)->delete();

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Periode magang berhasil dihapus');
    }
}
