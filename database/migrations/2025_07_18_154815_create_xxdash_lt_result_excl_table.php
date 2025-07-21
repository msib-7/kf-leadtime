<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('xxdash_lt_result_excl', function (Blueprint $table) {
            $table->id();
            
            $table->string('parent_lot_number', 80)->nullable();
            $table->string('lot_number', 80)->nullable();
            $table->string('kode_produk', 40)->nullable();
            $table->string('jenis_sediaan', 30)->nullable();
            $table->string('grup_minico', 10)->nullable();
            $table->string('prod_line', 240)->nullable();
            $table->string('prod_line_after', 240)->nullable();

            $table->string('waktu_transact_awal', 19)->nullable();
            $table->string('waktu_transact_akhir', 19)->nullable();
            $table->string('waktu_awal_ruah', 19)->nullable();
            $table->string('waktu_end_ruah', 19)->nullable();
            $table->string('waktu_awal_kemas', 19)->nullable();
            $table->string('waktu_bpp', 19)->nullable();
            $table->string('waktu_close_batch', 19)->nullable();
            $table->string('waktu_release', 19)->nullable();
            $table->string('waktu_shipping', 19)->nullable();

            $table->string('target', 8)->nullable();
            $table->string('status', 8)->nullable();

            $table->float('transact_mat_awal_release')->nullable();
            $table->float('transact_mat_awal_akhir')->nullable();
            $table->float('wip_bahan_baku')->nullable();
            $table->float('proses_produksi')->nullable();
            $table->float('wip_pro_kemas')->nullable();
            $table->float('kemas')->nullable();
            $table->float('bpp_release_fg')->nullable();
            $table->float('endruah_release_fg')->nullable();
            $table->float('bpp_closed')->nullable();
            $table->float('closed_release_fg')->nullable();
            $table->float('transact_mat_awal_shipping')->nullable();
            $table->float('release_fg_shipping')->nullable();

            $table->string('tag', 240)->nullable();
            $table->string('remark', 240)->nullable();
            $table->string('excluded_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xxdash_lt_result_excl');
    }
};
