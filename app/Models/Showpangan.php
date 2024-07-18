<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showpangan extends Model
{
    use HasFactory;

    protected $table = 'showpangans'; // Ensure this matches your table name

    protected $fillable = [
        'id_pangan',
        'id_operation_pangan',
    ];

    public function pangan()
    {
        return $this->belongsTo(Pangan::class, 'id_pangan');
    }

    public function TambahPangan()
    {
        return $this->belongsTo(TambahPangan::class, 'id_operation_pangan');
    }
}
