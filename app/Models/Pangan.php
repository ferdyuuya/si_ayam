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
    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak'); // Assuming 'id_ternak' is the foreign key in the Pangan table
    }
}
