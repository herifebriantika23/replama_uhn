<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class GuideController extends Controller
{
    public function index()
    {
        return view('guest.guide.index');
    }
}

