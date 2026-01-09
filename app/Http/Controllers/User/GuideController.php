<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    /**
     * Tampilkan halaman panduan untuk mahasiswa
     */
    public function index()
    {
        return view('user.guide.index');
    }
}
