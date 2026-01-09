<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Display laporan statistik.
     */
    public function index()
    {
        $total = Laporan::count();

        $disetujui = Laporan::where('status', 'disetujui')->count();
        $revisi    = Laporan::where('status', 'revisi')->count();
        $menunggu  = Laporan::where('status', 'menunggu')->count();

        return view('admin.statistik.index', compact(
            'total',
            'disetujui',
            'revisi',
            'menunggu'
        ));
    }
}

