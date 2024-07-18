<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KurangPangan extends Model
{
    // use HasFactory;

    protected $table = 'kurang_pangan';

    protected $fillable = [
        'stok_keluar',
        'stok_id',
        'updated_by'
    ];

    public $timestamps = true;
}
