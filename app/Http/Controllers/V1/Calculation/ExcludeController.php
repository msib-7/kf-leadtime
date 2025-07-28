<?php

namespace App\Http\Controllers\V1\Calculation;

use App\Http\Controllers\Controller;

use App\Models\V1\xxdash_lt_result;
use App\Models\V1\xxdash_lt_result_excl;
use App\Models\V1\tags;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExcludeController extends Controller
{
    //
    public function index()
    {
        // Data ini tidak lagi digunakan untuk tampilan awal DataTables,
        // karena DataTables akan diinisialisasi setelah filter dipilih.
        // Namun, Anda bisa tetap membiarkannya jika ada kebutuhan lain.
        // $results = xxdash_lt_result::query()
        //     ->limit(15)
        //     ->get();

        return view('v1.calculation.exclude.index'); // Tidak perlu compact('results') lagi
    }

    public function getCalculationData(Request $request)
    {
        if ($request->ajax()) {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            $line = $request->input('line');

            $query = xxdash_lt_result_excl::query();

            // Apply filters if month and year are provided
            if ($bulan && $tahun) {
                // Memfilter berdasarkan bulan dan tahun
                $query->whereRaw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$bulan])
                    ->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$tahun]);


                // Tambahkan filter line jika dipilih
                if ($line && $line != 'ALL') {
                    $query->where('prod_line', $line);
                }

                $query->where(function ($q) {
                    $q->where('prod_line', '!=', 'TOLL OUT')
                        ->where('kode_produk', 'not like', 'X%');
                });

                // PENTING: Memuat relasi targetProduk di sini
                $query->with(['tagRelation', 'targetProduk']);
            } else {
                return DataTables::of([])->make(true);
            }

            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('is_excluded', function($row) {
                // Menentukan apakah data sudah di-exclude berdasarkan kolom 'tag'
                // Jika 'tag' tidak null, berarti sudah di-exclude
                return $row->tag !== null;
            })
            ->make(true);
    }
}


    public function getAvailableLines()
    {
        $lines = xxdash_lt_result_excl::select('prod_line')
            ->distinct()
            ->orderBy('prod_line')
            ->pluck('prod_line');

        return response()->json($lines);
    }


    public function getAvailableYears()
    {
        // Mengambil tahun yang valid dari kolom waktu_release
        $years = xxdash_lt_result_excl::select(DB::raw("DISTINCT EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) as year"))
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
        $query = xxdash_lt_result_excl::select(DB::raw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) as month"))
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


    public function getAvailableTags()
    {
        $tags = tags::all(); // Ambil semua tag dari tabel Tag
        return response()->json($tags);
    }


    public function destroy(Request $request, $lot_number)
    {
        try {
            DB::beginTransaction();

            // Validasi input
            $request->validate([
                'tag' => 'required|string',
                'reason' => 'required|string'
            ]);

            // Ambil data berdasarkan lot_number
            $record = xxdash_lt_result_excl::where('lot_number', $lot_number)->first();

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found'
                ], 404);
            }

            // Update data
            $record->update([
                'transact_mat_awal_release' => null,
                'transact_mat_awal_akhir' => null,
                'wip_bahan_baku' => null,
                'proses_produksi' => null,
                'wip_pro_kemas' => null,
                'kemas' => null,
                'bpp_release_fg' => null,
                'endruah_release_fg' => null,
                'bpp_closed' => null,
                'closed_release_fg' => null,
                'transact_mat_awal_shipping' => null,
                'release_fg_shipping' => null,
                'tag' => $request->tag,
                'remark' => $request->reason,
                'excluded_by' => auth()->user()->fullname
                // 'excluded_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data successfully excluded'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to exclude data: ' . $e->getMessage()
            ], 500);
        }
    }


    // --- FUNGSI BARU UNTUK ROLLBACK ---
    public function rollback(Request $request, $lot_number)
    {
        try {
            DB::beginTransaction();
            // Ambil data dari tabel exclude
            $recordToRollback = xxdash_lt_result_excl::where('lot_number', $lot_number)->first();
            if (!$recordToRollback) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found in exclude table'
                ], 404);
            }
            // Ambil data asli dari tabel xxdash_lt_result (tabel sumber)
            $originalRecord = xxdash_lt_result::where('lot_number', $lot_number)->first();
            if (!$originalRecord) {
                // Jika data asli tidak ditemukan, kita tidak bisa mengembalikan nilai
                return response()->json([
                    'success' => false,
                    'message' => 'Original data not found in source table. Cannot rollback.'
                ], 404);
            }
            // Kembalikan nilai-nilai ke data asli
            $recordToRollback->update([
                'transact_mat_awal_release' => $originalRecord->transact_mat_awal_release,
                'transact_mat_awal_akhir' => $originalRecord->transact_mat_awal_akhir,
                'wip_bahan_baku' => $originalRecord->wip_bahan_baku,
                'proses_produksi' => $originalRecord->proses_produksi,
                'wip_pro_kemas' => $originalRecord->wip_pro_kemas,
                'kemas' => $originalRecord->kemas,
                'bpp_release_fg' => $originalRecord->bpp_release_fg,
                'endruah_release_fg' => $originalRecord->endruah_release_fg,
                'bpp_closed' => $originalRecord->bpp_closed,
                'closed_release_fg' => $originalRecord->closed_release_fg,
                'transact_mat_awal_shipping' => $originalRecord->transact_mat_awal_shipping,
                'release_fg_shipping' => $originalRecord->release_fg_shipping,
                'tag' => null, // Hapus tag dan remark setelah rollback
                'remark' => null,
                'excluded_by' => null, // Hapus juga siapa yang mengecualikan
                // 'excluded_at' => null // Jika Anda memiliki kolom ini
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data successfully rolled back to original values.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to rollback data: ' . $e->getMessage()
            ], 500);
        }
    }



    public function updateLineX(Request $request, $lot_number)
    {
        try {
            DB::beginTransaction();
            $record = xxdash_lt_result_excl::where('lot_number', $lot_number)->first();
            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found'
                ], 404);
            }
            // Update the prod_line_after column to 'Line X'
            $record->update([
                'prod_line_after' => 'LINE X'
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Prod Line After updated to "Line X" successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Prod Line After: ' . $e->getMessage()
            ], 500);
        }
    }


    // --- FUNGSI BARU UNTUK ROLLBACK PROD_LINE_AFTER ---
    public function rollbackLineX(Request $request, $lot_number)
    {
        try {
            DB::beginTransaction();
            $recordToUpdate = xxdash_lt_result_excl::where('lot_number', $lot_number)->first();
            if (!$recordToUpdate) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found in exclude table'
                ], 404);
            }
            // Ambil nilai prod_line asli dari tabel sumber (xxdash_lt_result)
            $originalRecord = xxdash_lt_result::where('lot_number', $lot_number)->first();
            if (!$originalRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Original data not found in source table. Cannot rollback prod_line_after.'
                ], 404);
            }
            // Kembalikan prod_line_after ke nilai prod_line asli
            $recordToUpdate->update([
                'prod_line_after' => $originalRecord->prod_line
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Prod Line After successfully rolled back to original value.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to rollback Prod Line After: ' . $e->getMessage()
            ], 500);
        }
    }





    // public function insertToExcl(Request $request)
    // {
    //     $bulan = $request->input('bulan');
    //     $tahun = $request->input('tahun');

    //     // Validasi parameter
    //     if (!$bulan || !$tahun) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Bulan dan Tahun harus dipilih'
    //         ]);
    //     }

    //     // Query data yang difilter
    //     $filteredData = xxdash_lt_result::whereRaw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$bulan])
    //         ->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$tahun])
    //         ->where('prod_line', '!=', 'TOLL OUT')
    //         ->where('kode_produk', 'not like', 'X%')
    //         ->get();

    //     // Proses copy ke tabel baru
    //     try {
    //         DB::beginTransaction();


    //         // DIBAWAH INI FUNCTION UNTUK HANYA MENGAMBIL KOLOM YANG DIPILIH SAJA TIDAK MENYERTAKAN ID, CREATED_AT DAN UPDATED_AT
    //         // foreach ($filteredData as $data) {
    //         //     // Periksa apakah data sudah ada di tabel excl berdasarkan lot_number
    //         //     $exists = xxdash_lt_result_excl::where('lot_number', $data->lot_number)->exists();

    //         //     if (!$exists) {
    //         //         // Hanya ambil kolom yang ada di tabel excl
    //         //         xxdash_lt_result_excl::create($data->only([
    //         //             'parent_lot_number',
    //         //             'lot_number',
    //         //             'kode_produk',
    //         //             'jenis_sediaan',
    //         //             'grup_minico',
    //         //             'prod_line',
    //         //             'waktu_transact_awal',
    //         //             'waktu_transact_akhir',
    //         //             'waktu_awal_ruah',
    //         //             'waktu_end_ruah',
    //         //             'waktu_awal_kemas',
    //         //             'waktu_bpp',
    //         //             'waktu_close_batch',
    //         //             'waktu_release',
    //         //             'waktu_shipping',
    //         //             'target',
    //         //             'status',
    //         //             'transact_mat_awal_release',
    //         //             'transact_mat_awal_akhir',
    //         //             'wip_bahan_baku',
    //         //             'proses_produksi',
    //         //             'wip_pro_kemas',
    //         //             'kemas',
    //         //             'bpp_release_fg',
    //         //             'endruah_release_fg',
    //         //             'bpp_closed',
    //         //             'closed_release_fg',
    //         //             'transact_mat_awal_shipping',
    //         //             'release_fg_shipping'
    //         //         ]));
    //         //     }
    //         // }


    //         // DIBAWAH INI UNTUK TIDAK DIIKUT SERTAKAN CREATED_AT DAN UPDATED_AT
    //         // foreach ($filteredData as $data) {
    //         //     // Periksa apakah data sudah ada di tabel excl
    //         //     $exists = xxdash_lt_result_excl::where('lot_number', $data->lot_number)
    //         //         ->whereRaw("EXTRACT(MONTH FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$bulan])
    //         //         ->whereRaw("EXTRACT(YEAR FROM TO_TIMESTAMP(waktu_release, 'MM/DD/YYYY HH24:MI:SS')) = ?", [$tahun])
    //         //         ->exists();

    //         //     if (!$exists) {
    //         //         xxdash_lt_result_excl::create($data->toArray());
    //         //     }
    //         // }


    //         // DIBAWAH IN FUNCTION UNTUK IKUT SERTAKAN CREATED_AT DAN UPDATED_AT
    //         foreach ($filteredData as $data) {
    //             // Periksa apakah data sudah ada di tabel excl
    //             $exists = xxdash_lt_result_excl::where('lot_number', $data->lot_number)->exists();

    //             if (!$exists) {
    //                 // Menambahkan created_at dan updated_at
    //                 $dataToInsert = $data->toArray();
    //                 $dataToInsert['created_at'] = now();
    //                 $dataToInsert['updated_at'] = now();
    //                 xxdash_lt_result_excl::create($dataToInsert);
    //             }
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'message' => count($filteredData) . ' data berhasil dikirim ke tabel exclude'
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    //         ]);
    //     }
    // }
}
