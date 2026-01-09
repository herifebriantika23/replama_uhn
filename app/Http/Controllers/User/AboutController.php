<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Tampilkan halaman tentang website magang
     */
    public function index()
    {
        return view('user.about.index');
    }
}

