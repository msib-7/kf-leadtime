<?php

namespace App\Http\Controllers\V1\PengukuranAwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PunchAtasController extends Controller
{
    public function index()
    {
        return view('v1.pengukuran.awal.punch.atas.index');
    }
}
