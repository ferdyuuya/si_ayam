<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangan extends Model
{
    use HasFactory;
    protected $table = 'pangan';
    protected $fillable = [
        'pengeluaran_harian',
        'stok_sekarang',
        'pemasukan_bulanan',
        'update_pangan',
        'updated_by'
    ];
}
