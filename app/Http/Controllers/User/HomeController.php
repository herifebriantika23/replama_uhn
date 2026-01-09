<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');   // ambil kata pencarian
        $perPage = 10;                         // jumlah data per halaman

        // ====== DATA LAPORAN DENGAN FITUR PENCARIAN ======
        $laporans = Laporan::when($search, function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%")
                              ->orWhere('nama', 'like', "%{$search}%")
                              ->orWhere('nim', 'like', "%{$search}%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage)
                    ->withQueryString();       // agar pagination tidak hilang saat search


        // ====== DATA LAPORAN TERBARU ======
        $laporanTerbaru = Laporan::orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('user.beranda.index', compact('laporans', 'laporanTerbaru', 'search'));
    }
}

