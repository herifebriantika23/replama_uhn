<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Laporan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Total data
        $totalFakultas = Fakultas::count();
        $totalProdi    = Prodi::count();
        $totalLaporan  = Laporan::count();

        // Statistik laporan
        $laporanMenunggu  = Laporan::where('status', 'menunggu')->count();
        $laporanDisetujui = Laporan::where('status', 'disetujui')->count();
        $laporanRevisi    = Laporan::where('status', 'revisi')->count();

        return view('admin.dashboard', compact(
            'totalFakultas',
            'totalProdi',
            'totalLaporan',
            'laporanMenunggu',
            'laporanDisetujui',
            'laporanRevisi'
        ));
    }
}
