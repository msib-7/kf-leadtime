<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class xxdash_lt_result_excl extends Model
{
    //
    use HasFactory;


    protected $table = 'xxdash_lt_result_excl';
    protected $guarded = []; // Atau tentukan kolom yang ingin diisi
    public $timestamps = false; // Pastikan ini diatur ke false
    // protected $primaryKey = 'lot_number'; // Menetapkan lot_number sebagai primary key
    // public $incrementing = false; // Menetapkan bahwa lot_number bukan auto-increment
}
