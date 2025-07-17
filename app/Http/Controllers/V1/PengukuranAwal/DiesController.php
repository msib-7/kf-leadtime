<?php

namespace App\Http\Controllers\V1\PengukuranAwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiesController extends Controller
{
    public function index()
    {
        return view('v1.pengukuran.awal.dies.index');
    }
}
