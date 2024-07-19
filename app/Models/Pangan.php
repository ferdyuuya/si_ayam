<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangan extends Model
{
    use HasFactory;
    protected $table = 'pangan';
    protected $fillable = [
        'stok_sekarang'
    ];
    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak'); // Assuming 'id_ternak' is the foreign key in the Pangan table
    }

    public function operasi()
    {
        return $this->hasMany(TambahPangan::class, 'id_operasi');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
