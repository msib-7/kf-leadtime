<?php

namespace App\Exports\Dashboard;

use App\Models\WaktuPemeriksaan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiPengukuranExport implements WithMultipleSheets
{
    use Exportable;

    protected $reportData;
    protected $cetakanKe;
    protected $titlePdf;
    protected $shifts;
    protected $masaPeriksa;
    protected $ruangan;
    protected $syarat;
    protected $jenisDpSyarat;
    protected $request;
    protected $dokumen;
    protected $url;

    public function __construct($reportData, $cetakanKe, $titlePdf, $shifts, $masaPeriksa, $ruangan, $syarat, $jenisDpSyarat, $request, $dokumen, $url)
    {
        $this->reportData = $reportData;
        $this->cetakanKe = $cetakanKe;
        $this->titlePdf = $titlePdf;
        $this->shifts = $shifts;
        $this->masaPeriksa = $masaPeriksa;
        $this->ruangan = $ruangan;
        $this->syarat = $syarat;
        $this->jenisDpSyarat = $jenisDpSyarat;
        $this->request = $request;
        $this->dokumen = $dokumen;
        $this->url = $url;
    }

    public function sheets(): array
    {
        $sheets = [];

        // if ($this->shifts === 'all') {
            $halaman = 1;
            $total = $this->shifts->count();
            foreach ($this->shifts as $shift) {
                $filteredData = $this->reportData->where('shift_pemeriksaan', $shift->id);

                $sheets[] = new PengukuranSheet( 
                    $filteredData, 
                    $this->cetakanKe, 
                    $this->titlePdf, 
                    $shift->shift, 
                    $shift->start_time . ' - ' . $shift->end_time,
                    $this->masaPeriksa, 
                    $this->ruangan, 
                    $this->syarat, 
                    $this->jenisDpSyarat, 
                    $this->request, 
                    $this->dokumen, 
                    $this->url,
                    $halaman,
                    $total
                );

                $halaman++;
            }

        // }else{
        //     $sheets[] = new PengukuranSheet( 
        //         $this->reportData, 
        //         $this->cetakanKe, 
        //         $this->titlePdf, 
        //         $this->shifts, 
        //         $this->shifts->start_time . ' - ' . $this->shifts->end_time,
        //         $this->masaPeriksa, 
        //         $this->ruangan, 
        //         $this->syarat, 
        //         $this->jenisDpSyarat, 
        //         $this->request, 
        //         $this->dokumen, 
        //         $this->url
        //     );
        // }
        // dd($sheets);
        return $sheets;
    }
}
