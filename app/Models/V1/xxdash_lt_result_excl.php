<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\V1\xxdash_lt_target_produk;

class xxdash_lt_result_excl extends Model
{
    //
    use HasFactory;


    protected $table = 'xxdash_lt_result_excl';
    protected $guarded = []; // Atau tentukan kolom yang ingin diisi
    // public $timestamps = false; // Pastikan ini diatur ke false
    // protected $primaryKey = 'lot_number'; // Menetapkan lot_number sebagai primary key
    // public $incrementing = false; // Menetapkan bahwa lot_number bukan auto-increment
    public function tagRelation()
    {
        return $this->belongsTo(tags::class, 'tag', 'id'); // 'tag' adalah foreign key di xxdash_lt_result_excl, 'id' adalah primary key di tags
    }

    public function targetProduk()
    {
        return $this->hasOne(xxdash_lt_target_produk::class, 'kode_produk', 'kode_produk');
            // ->where('prod_line', $this->prod_line); // Menggunakan $this untuk mencocokkan prod_line
    }
}
