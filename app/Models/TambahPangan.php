<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahPangan extends Model
{
    use HasFactory;

    protected $table = 'tambah_pangan';

    protected $fillable = [
        'stok_masuk',
        'stok_id',
        'id_ternak',
        'updated_by',
    ];

    public $timestamps = true;

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak'); // Define the relationship if necessary
    }
}
