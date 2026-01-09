<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * =========================
     * LIST DATA FAKULTAS
     * =========================
     */
    public function index()
    {
        $fakultas = Fakultas::orderBy('nama')->get();

        return view('admin.fakultas.index', compact('fakultas'));
    }

    /**
     * =========================
     * SIMPAN FAKULTAS BARU
     * (DARI MODAL TAMBAH)
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:fakultas,nama',
        ]);

        Fakultas::create([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil ditambahkan');
    }

    /**
     * =========================
     * UPDATE FAKULTAS
     * (DARI MODAL EDIT)
     * =========================
     */
    public function update(Request $request, $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:fakultas,nama,' . $fakultas->id,
        ]);

        $fakultas->update([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil diperbarui');
    }

    /**
     * =========================
     * HAPUS FAKULTAS
     * (DARI MODAL KONFIRMASI)
     * =========================
     */
    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil dihapus');
    }
}

