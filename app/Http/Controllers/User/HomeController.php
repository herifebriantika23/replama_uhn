<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->query('search');
        $perPage = 5;

        $laporans = Laporan::with(['user', 'prodi'])
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })
                ->orWhereHas('prodi', function ($p) use ($search) {
                    $p->where('nama', 'like', "%{$search}%");
                });
            });
        })
        ->latest()
        ->paginate($perPage)
        ->withQueryString();

        $laporanTerbaru = Laporan::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('user.beranda.index', compact(
            'laporans',
            'laporanTerbaru',
            'search'
        ));
    }
}


