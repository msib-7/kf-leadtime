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
        Schema::create('xxdash_lt_target_produk', function (Blueprint $table) {
            $table->id();

            $table->string('prod_line', 240);
            $table->string('kode_produk', 40);
            $table->string('nama_produk', 240);

            $table->double('tahun')->nullable();
            $table->double('target')->nullable();
            $table->double('transact_mat_awal_release')->nullable();
            $table->double('transact_mat_awal_akhir')->nullable();
            $table->double('wip_bahan_baku')->nullable();
            $table->double('proses_produksi')->nullable();
            $table->double('wip_pro_kemas')->nullable();
            $table->double('kemas')->nullable();
            $table->double('bpp_release_fg')->nullable();
            $table->double('endruah_release_fg')->nullable();
            $table->double('closed_release_fg')->nullable();
            $table->double('bpp_closed')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xxdash_lt_target_produk');
    }
};
