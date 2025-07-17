<?php

namespace App\Http\Controllers;

use App\Models\NomorDokumen;
use App\Models\Roles;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Exception;
use Imagick;
use ImagickPixel;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    public function index()
    {
        return view('v1.dashboard');
    }
 
}
