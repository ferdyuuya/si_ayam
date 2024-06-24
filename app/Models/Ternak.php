<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    use HasFactory;
    protected $table = 'ternak';
    protected $fillable = [
        'ayam_mati',
        'ayam_sakit',
        'ayam_berhasil',
        'total_ayam',
        'total_awal_ayam',
        'is_ongoing',
    ];
}
