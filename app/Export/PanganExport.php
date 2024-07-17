<?php

namespace App\Exports;

use App\Models\Pangan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PanganExport
{
    public function collection()
    {
        return Pangan::all('pengeluaran_stok', 'pemasukan_stok', 'stok_sekarang','update_pangan','updated_by');
    }
}
