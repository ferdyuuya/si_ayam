<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangan extends Model
{
    use HasFactory;
    protected $table = 'pangan';
    protected $fillable = [
        'pengeluaran_stok',
        'stok_sekarang',
        'pemasukan_stok',
        'update_pangan',
        'updated_by'
    ];
}
