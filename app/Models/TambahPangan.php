<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahPangan extends Model
{
    use HasFactory;

    protected $table = 'operation_pangan';

    protected $fillable = [
        'stok_masuk',
        'stok_keluar',
        'stok_id',
        'id_ternak',
        'updated_by',
    ];

    public $timestamps = true;

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak'); // Define the relationship if necessary
    }
    public function stok()
    {
        return $this->belongsTo(Pangan::class, 'stok_id'); // Define the relationship if necessary
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
