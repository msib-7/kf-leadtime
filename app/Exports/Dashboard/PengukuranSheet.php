<?php

namespace App\Exports\Dashboard;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengukuranSheet implements 
        FromCollection,
        WithHeadings,
        WithMapping,
        WithStyles,
        WithProperties,
        WithDrawings,
        WithCustomStartCell,
        WithTitle
{
    use Exportable;

    protected $filteredData;
    protected $cetakanKe;
    protected $titlePdf;
    protected $shifts;
    protected $jam;
    protected $masaPeriksa;
    protected $ruangan;
    protected $syarat;
    protected $jenisDpSyarat;
    protected $request;
    protected $dokumen;
    protected $url;
    protected $halaman;
    protected $total;

    public function __construct($filteredData, $cetakanKe, $titlePdf, $shifts, $jam, $masaPeriksa, $ruangan, $syarat, $jenisDpSyarat, $request, $dokumen, $url, $halaman, $total)
    {
        $this->filteredData = $filteredData;
        $this->cetakanKe = $cetakanKe;
        $this->titlePdf = $titlePdf;
        $this->shifts = $shifts;
        $this->jam = $jam;
        $this->masaPeriksa = $masaPeriksa;
        $this->ruangan = $ruangan;
        $this->syarat = $syarat;
        $this->jenisDpSyarat = $jenisDpSyarat;
        $this->request = $request;
        $this->dokumen = $dokumen;
        $this->url = $url;
        $this->halaman = $halaman;
        $this->total = $total;
    }

    public function title(): string
    {
        // Return the title of the sheet
        return 'Monitoring Shift ' . $this->shifts;
    }

    public function collection()
    {
        return collect($this->filteredData);
    }

    public function headings(): array
    {
        // For Excel exports, true rowspans are not supported in headings.
        // To simulate a rowspan, you can return multi-row headings and merge cells in styles().
        return [
            ['Tanggal', 'Pemeriksaan'],
            ['', 'Suhu', 'Suhu Min', 'Suhu Max', 'RH', 'DP', 'Pukul', 'Pelaksana','', 'Verifikator','']
        ];
    }

    public function map($row): array
    {
        // Map your $row data to the columns
        return [
            // Example: $row->col1, $row->col2, $row->col3
        ];
    }

    public function startCell(): string
    {
        // Define the starting cell, e.g. 'A1'
        return 'A9';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setShowGridlines(false);

        $sheet->mergeCells('A9:A10');
        $sheet->mergeCells('B9:K9');
        $sheet->mergeCells('H10:I10');
        $sheet->mergeCells('J10:K10');
        $sheet->getStyle('A9:K10')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');
        $sheet->getStyle('A9:K9')->getFont()->setBold(true);
        $sheet->getStyle('A9:K9')->getFont()->setSize(12);
        $sheet->getStyle('B10:K10')->getFont()->setBold(true);
        $sheet->getStyle('B10:K10')->getFont()->setSize(12);

        $sheet->getStyle('A9:A10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A9:K9')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B10:K10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A9:K10')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A9:K10')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getRowDimension(9)->setRowHeight(20);
        $sheet->getRowDimension(10)->setRowHeight(20);
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(25);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(25);
        $sheet->getColumnDimension('K')->setWidth(25);

        // $sheet->setShowGridlines(false);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(20);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A1:K1');

        $sheet->setCellValue('A1', $this->titlePdf ?? 'FORMULIR MONITORING RUANGAN (SUHU, RH, DP)');
       
        //Info kiri
        $sheet->setCellValue('H3', 'Bulan, Tahun');
        $sheet->setCellValue('H4', 'Line/Lokasi');
        $sheet->setCellValue('H5', 'Shift');
        $sheet->setCellValue('H6', 'Jam');
        $sheet->setCellValue('I3', ': '.$this->masaPeriksa);
        $sheet->setCellValue('I4', ': '. $this->ruangan->subDepartments->name . ' - ' . $this->ruangan->subDepartments->departments->name);
        $sheet->setCellValue('I5', ': Shift ' . $this->shifts);
        $sheet->setCellValue('I6', ': (' . $this->jam.')');

        //Info kolom sebelah kanan
        $sheet->setCellValue('J3', 'Nama Ruangan');
        $sheet->setCellValue('J4', 'Jenis Ruangan');
        $sheet->setCellValue('J5', 'DP');
        $sheet->setCellValue('J6', 'No. Ruangan');
        $sheet->setCellValue('J7', 'No. Alat');
        $sheet->setCellValue('K3', ': ' . $this->ruangan->area_name);
        $sheet->setCellValue('K4', ': ' . $this->ruangan->jenisRuangan->name);
        $sheet->setCellValue('K5', ': ' . $this->ruangan->jenisDp->name);
        $sheet->setCellValue('K6', ': ' . $this->ruangan->room_no);
        $sheet->setCellValue('K7', ': ' . $this->ruangan->no_alat);

        // Data
        $data = $this->filteredData;
        $row = 11; // Starting row for data
        $lastrow = 0;
        foreach ($data as $item) {

            $sheet->setCellValue('A' . $row, $item['tgl_pemeriksaan']. ' ' . $this->masaPeriksa);
            $sheet->setCellValue('B' . $row, $item['suhu']);
            $sheet->setCellValue('C' . $row, $item['suhu_min']);
            $sheet->setCellValue('D' . $row, $item['suhu_max']);
            $sheet->setCellValue('E' . $row, $item['rh']);
            $sheet->setCellValue('F' . $row, $item['dp']);
            $sheet->setCellValue('G' . $row, $item['jam_pemeriksaan']);
            $sheet->setCellValue('H' . $row, $item['pelaksana']);
            $sheet->setCellValue('J' . $row, $item['verifikator']); // Empty cell for Verifikasi

            $colorSuhu = $this->getColorARGB($item['suhu'], $this->syarat, 'suhu');
            if ($colorSuhu) {
                $sheet->getStyle('B' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorSuhu);
            }

            $colorSuhuMin = $this->getColorARGB($item['suhu_min'], $this->syarat, 'suhu_min');
            if ($colorSuhuMin) {
                $sheet->getStyle('C' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorSuhuMin);
            }

            $colorSuhuMax = $this->getColorARGB($item['suhu_max'], $this->syarat, 'suhu_max');
            if ($colorSuhuMax) {
                $sheet->getStyle('D' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorSuhuMax);
            }

            $colorRh = $this->getColorARGB($item['rh'], $this->syarat, 'rh');
            if ($colorRh) {
                $sheet->getStyle('E' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorRh);
            }

            $colorDp = $this->getColorARGB($item['dp'], $this->jenisDpSyarat, 'dp');
            if ($colorDp) {
                $sheet->getStyle('F' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($colorDp);
            }

            // Merge H:I and J:K for this row
            $sheet->mergeCells('H' . $row . ':I' . $row);
            $sheet->mergeCells('J' . $row . ':K' . $row);

            // Center alignment for each cell in the row
            foreach (range('A', 'K') as $col) {
            $sheet->getStyle($col . $row)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER);

            // Set border style thin for each cell
            $sheet->getStyle($col . $row)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);
            }

            // Center alignment for merged cells (redundant but safe)
            $sheet->getStyle('H' . $row . ':I' . $row)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle('J' . $row . ':K' . $row)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

            // Set border style thin for merged cells
            $sheet->getStyle('H' . $row . ':I' . $row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('J' . $row . ':K' . $row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

            // Increment row counter
            $lastrow = ++$row;
        }

        //Footer
        $nomorDokumen = '';
        foreach ($this->dokumen as $index => $item) {
            $nomorDokumen .= $item->nomor_dokumen;
            if ($index < count($this->dokumen) - 1) {
                $nomorDokumen .= ' / ';
            }
        }

        $sheet->setCellValue('A' . ($lastrow + 2), $nomorDokumen);
        $sheet->getStyle('A' . ($lastrow + 2))->getFont()->setBold(true);
        $sheet->getStyle('A' . ($lastrow + 2))->getFont()->setSize(11);
        $sheet->getStyle('A' . ($lastrow + 2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('A' . ($lastrow + 2))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A' . ($lastrow + 2))->getFont()->setItalic(true);

        $sheet->getStyle('A' . ($lastrow + 3) . ':K' . ($lastrow + 3))
            ->getBorders()
            ->getTop()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('A' . ($lastrow + 4), 'Dicetak dari halaman '. $this->url);
        $sheet->getStyle('A' . ($lastrow + 4))->getFont()->setSize(11);
        $sheet->getStyle('A' . ($lastrow + 4))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('A' . ($lastrow + 4))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A' . ($lastrow + 4))->getFont()->setItalic(true);

        $sheet->setCellValue('A' . ($lastrow + 5), 'Cetakan ke-'. $this->cetakanKe. ' pada '. date('d M Y'). ' oleh '. auth()->user()->email);
        $sheet->getStyle('A' . ($lastrow + 5))->getFont()->setSize(11);
        $sheet->getStyle('A' . ($lastrow + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('A' . ($lastrow + 5))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A' . ($lastrow + 5))->getFont()->setItalic(true);

        // Set page number (current page of total pages) in cell K
        $sheet->setCellValue('K' . ($lastrow + 5), 'Halaman ' . $this->halaman . ' dari '. $this->total);
        $sheet->getStyle('K' . ($lastrow + 5))->getFont()->setSize(11);
        $sheet->getStyle('K' . ($lastrow + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('K' . ($lastrow + 5))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('K' . ($lastrow + 5))->getFont()->setItalic(true);
        
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('assets/logo/kalbe_farma.png'));
        $drawing->setCoordinates('A2');

        $drawing->setWidth(165);

        return $drawing;
    }

    public function properties(): array
    {
        // Return an array of document properties   
        return [
            'creator'        => 'Monitoring Ruangan - Kalbe Farma',
            'lastModifiedBy' => auth()->user()->email,
            'title'          => $this->titlePdf ?? 'Export',
            'description'    => 'Document Exported by System, request by ' . auth()->user()->email . '.',
            'subject'        => 'Monitoring Ruangan',
            'keywords'       => 'export,spreadsheet',
            'category'       => 'Monitoring Ruangan',
            'company'        => 'PT Kalbe Farma Tbk',
        ];
    }

    private function getColorARGB($value, $syarat, $type)
    {
        if ($value === 'NA' || !$syarat) {
            return null;
        }

        switch ($type) {
            case 'suhu':
                if ($value <= $syarat->syarat_suhu_min) {
                    return 'FFFF00'; // Kuning
                } elseif ($value >= $syarat->syarat_suhu_max) {
                    return 'FF0000'; // Merah
                } else {
                    return 'FFF';
                }
            case 'suhu_min':
                if (
                    $value <= $syarat->batas_bawah_suhu_alert && $value > $syarat->batas_bawah_suhu_action &&
                    $value < $syarat->batas_atas_suhu_alert && $value < $syarat->batas_atas_suhu_action
                ) {
                    return 'FFFF00'; // Kuning
                } elseif (
                    $value < $syarat->batas_bawah_suhu_alert && $value <= $syarat->batas_bawah_suhu_action &&
                    $value < $syarat->batas_atas_suhu_alert && $value < $syarat->batas_atas_suhu_action
                ) {
                    return 'FF0000'; // Merah
                } elseif (
                    $value > $syarat->batas_bawah_suhu_alert && $value > $syarat->batas_bawah_suhu_action &&
                    $value >= $syarat->batas_atas_suhu_alert && $value < $syarat->batas_atas_suhu_action
                ) {
                    return 'FFFF00'; // Kuning
                } elseif (
                    $value > $syarat->batas_bawah_suhu_alert && $value > $syarat->batas_bawah_suhu_action &&
                    $value > $syarat->batas_atas_suhu_alert && $value >= $syarat->batas_atas_suhu_action
                ) {
                    return 'FF0000'; // Merah
                } else {
                    return 'FFF';
                }
            case 'suhu_max':
                if (
                    $value <= $syarat->batas_bawah_suhu_alert && $value > $syarat->batas_bawah_suhu_action &&
                    $value < $syarat->batas_atas_suhu_alert && $value < $syarat->batas_atas_suhu_action
                ) {
                    return 'FFFF00'; // Kuning
                } elseif (
                    $value < $syarat->batas_bawah_suhu_alert && $value <= $syarat->batas_bawah_suhu_action &&
                    $value < $syarat->batas_atas_suhu_alert && $value < $syarat->batas_atas_suhu_action
                ) {
                    return 'FF0000'; // Merah
                } elseif (
                    $value > $syarat->batas_bawah_suhu_alert && $value > $syarat->batas_bawah_suhu_action &&
                    $value >= $syarat->batas_atas_suhu_alert && $value < $syarat->batas_atas_suhu_action
                ) {
                    return 'FFFF00'; // Kuning
                } elseif (
                    $value > $syarat->batas_bawah_suhu_alert && $value > $syarat->batas_bawah_suhu_action &&
                    $value > $syarat->batas_atas_suhu_alert && $value >= $syarat->batas_atas_suhu_action
                ) {
                    return 'FF0000'; // Merah
                } else {
                    return 'FFF';
                }
            case 'rh':
                if (
                    $value <= $syarat->batas_bawah_rh_alert && $value > $syarat->batas_bawah_rh_action &&
                    $value < $syarat->batas_atas_rh_alert && $value < $syarat->batas_atas_rh_action
                ) {
                    return 'FFFF00'; // Kuning
                } elseif (
                    $value < $syarat->batas_bawah_rh_alert && $value <= $syarat->batas_bawah_rh_action &&
                    $value < $syarat->batas_atas_rh_alert && $value < $syarat->batas_atas_rh_action
                ) {
                    return 'FF0000'; // Merah
                } elseif (
                    $value > $syarat->batas_bawah_rh_alert && $value > $syarat->batas_bawah_rh_action &&
                    $value >= $syarat->batas_atas_rh_alert && $value < $syarat->batas_atas_rh_action
                ) {
                    return 'FFFF00'; // Kuning
                } elseif (
                    $value > $syarat->batas_bawah_rh_alert && $value > $syarat->batas_bawah_rh_action &&
                    $value > $syarat->batas_atas_rh_alert && $value >= $syarat->batas_atas_rh_action
                ) {
                    return 'FF0000'; // Merah
                } else {
                    return 'FFF';
                }
            case 'dp':
                if ($value <= $syarat->alert && $value > $syarat->action) {
                    return 'FFFF00'; // Kuning
                } elseif ($value < $syarat->alert && $value <= $syarat->action) {
                    return 'FF0000'; // Merah
                } else {
                    return 'FFF';
                }
            default:
                return null;
        }
    }
}
