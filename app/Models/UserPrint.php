<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrint extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $guarded;
}
