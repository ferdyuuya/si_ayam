<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';
    protected $fillable = [
        'id_ternak',
        'id_user',
        'id_pangan',
        'ayam_mati',
        'ayam_hidup',
        'ayam_sakit',
    ];
}
