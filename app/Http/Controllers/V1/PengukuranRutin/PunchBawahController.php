<?php

namespace App\Http\Controllers\V1\PengukuranRutin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PunchBawahController extends Controller
{
    public function index()
    {
        return view('v1.pengukuran.rutin.punch.bawah.index');
    }
}
