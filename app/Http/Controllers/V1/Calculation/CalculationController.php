<?php

namespace App\Http\Controllers\V1\Calculation;

use App\Http\Controllers\Controller;
use App\Models\V1\xxdash_lt_result;
use App\Models\V1\xxdash_lt_result_excl; // Pastikan model ini sudah ada dan benar
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CalculationController extends Controller
{
    public function index()
    {
        // Data ini tidak lagi digunakan untuk tampilan awal DataTables,
        // karena DataTables akan diinisialisasi setelah filter dipilih.
        // Namun, Anda bisa tetap membiarkannya jika ada kebutuhan lain.
        // $results = xxdash_lt_result::query()
        //     ->limit(15)
        //     ->get();

        return view('v1.calculation.index'); // Tidak perlu compact('results') lagi
    }

    /**
     * Fungsi ini akan digunakan untuk mengambil data untuk DataTables secara server-side.
     * Data akan difilter berdasarkan bulan dan tahun yang dipilih.
     */
    public function getCalculationData(Request $request)
    {
        if ($request->ajax()) {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');

            $query = xxdash_lt_result::query();

            // Apply filters if month and year are provided
            if ($bulan && $tahun) {
                // Memfilter berdasarkan bulan dan tahun
                $query->whereRaw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$bulan])
                    ->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$tahun]);

                $query->where(function ($q) {
                    $q->where('prod_line', '!=', 'TOLL OUT')
                        ->where('kode_produk', 'not like', 'X%');
                });
            } else {
                return DataTables::of([])->make(true);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->make(true);
        }
    }


    public function getAvailableYears()
    {
        // Mengambil tahun yang valid dari kolom waktu_release
        $years = xxdash_lt_result::select(DB::raw("DISTINCT EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) as year"))
            ->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) IS NOT NULL") // Pastikan tahun tidak null
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->map(function ($year) {
                return (int) $year; // Pastikan tahun adalah integer
            })
            ->filter(function ($year) {
                return $year > 0; // Hanya ambil tahun yang lebih besar dari 0
            });

        return response()->json($years);
    }



    public function getAvailableMonths(Request $request)
    {
        // Ambil tahun dari request jika ada, jika tidak, ambil semua data
        $tahun = $request->input('tahun');

        // Query untuk mendapatkan bulan yang memiliki data
        $query = xxdash_lt_result::select(DB::raw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) as month"))
            ->distinct();

        // Jika tahun dipilih, tambahkan filter tahun
        if ($tahun) {
            $query->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$tahun]);
        }

        // Ambil bulan yang ada datanya
        $months = $query->get()->map(function ($item) {
            return [
                'id' => (int) $item->month,
                'name' => Carbon::create()->month((int) $item->month)->translatedFormat('F') // Nama bulan dalam bahasa lokal
            ];
        });

        return response()->json($months);
    }


    public function insertToExcl(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    // Validasi parameter
    if (!$bulan || !$tahun) {
        return response()->json([
            'success' => false,
            'message' => 'Bulan dan Tahun harus dipilih'
        ]);
    }

    // Query data yang difilter
    $filteredData = xxdash_lt_result::whereRaw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$bulan])
        ->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$tahun])
        ->where('prod_line', '!=', 'TOLL OUT')
        ->where('kode_produk', 'not like', 'X%')
        ->get();

    // Proses copy ke tabel baru
    try {
        DB::beginTransaction();
        
        foreach ($filteredData as $data) {
            // Periksa apakah data sudah ada di tabel excl berdasarkan lot_number
            $exists = xxdash_lt_result_excl::where('lot_number', $data->lot_number)->exists();
                
            if (!$exists) {
                // Hanya ambil kolom yang ada di tabel excl
                xxdash_lt_result_excl::create($data->only([
                    'parent_lot_number',
                    'lot_number',
                    'kode_produk',
                    'jenis_sediaan',
                    'grup_minico',
                    'prod_line',
                    'waktu_transact_awal',
                    'waktu_transact_akhir',
                    'waktu_awal_ruah',
                    'waktu_end_ruah',
                    'waktu_awal_kemas',
                    'waktu_bpp',
                    'waktu_close_batch',
                    'waktu_release',
                    'waktu_shipping',
                    'target',
                    'status',
                    'transact_mat_awal_release',
                    'transact_mat_awal_akhir',
                    'wip_bahan_baku',
                    'proses_produksi',
                    'wip_pro_kemas',
                    'kemas',
                    'bpp_release_fg',
                    'endruah_release_fg',
                    'bpp_closed',
                    'closed_release_fg',
                    'transact_mat_awal_shipping',
                    'release_fg_shipping'
                ]));
            }
        }
        
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => count($filteredData) . ' data berhasil dikirim ke tabel exclude'
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}





}
