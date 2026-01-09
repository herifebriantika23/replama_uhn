<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * =========================
     * INDEX (LIST + MODAL)
     * =========================
     */
    public function index()
    {
        $prodi = Prodi::with('fakultas')
            ->orderBy('nama')
            ->get();

        // ⬅️ WAJIB: untuk modal tambah & edit
        $fakultas = Fakultas::orderBy('nama')->get();

        return view('admin.prodi.index', compact('prodi', 'fakultas'));
    }

    /**
     * =========================
     * STORE (TAMBAH)
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama' => 'required|string|max:255|unique:prodis,nama,NULL,id,fakultas_id,' . $request->fakultas_id,
        ]);

        Prodi::create([
            'fakultas_id' => $request->fakultas_id,
            'nama'        => $request->nama,
        ]);

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Program Studi berhasil ditambahkan');
    }

    /**
     * =========================
     * UPDATE (EDIT)
     * =========================
     */
    public function update(Request $request, string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama' => 'required|string|max:255|unique:prodis,nama,' .
                      $prodi->id . ',id,fakultas_id,' . $request->fakultas_id,
        ]);

        $prodi->update([
            'fakultas_id' => $request->fakultas_id,
            'nama'        => $request->nama,
        ]);

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Program Studi berhasil diperbarui');
    }

    /**
     * =========================
     * DESTROY (HAPUS)
     * =========================
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);

        // Proteksi relasi (jika ada)
        if (method_exists($prodi, 'users') && $prodi->users()->exists()) {
            return back()->with(
                'error',
                'Program Studi tidak dapat dihapus karena masih digunakan.'
            );
        }

        $prodi->delete();

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Program Studi berhasil dihapus');
    }
}
