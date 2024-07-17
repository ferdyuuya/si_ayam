<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use App\Models\Ternak;
use App\Models\TambahPangan;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\PanganExport;
use App\Models\KurangPangan;
use Illuminate\Support\Facades\DB;

// use PDF;

class PanganController extends Controller
{
    public function index()
    {
        return view('pangan.index', [
            'pangan' => Pangan::paginate(10),
        ]);
    }

    public function add()
    {
        return view('pangan.input_pangan');
    }

    public function addStok(Request $request)
    {
        if (Auth::user()->status != 0) { // 0 means false == not pengurus
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menambahkan stok.');
        }
        $request->validate(['tambah_pangan' => 'required|integer|min:0']);
        try {
            $latestPangan = Pangan::latest('updated_at')->first();
            $takeId_ternak = Ternak::where('is_ongoing', 1)->first();
            if (!$latestPangan) {
                return redirect()->back()->with('error', 'No Pangan record found.');
            }

            $tambahPangan = new TambahPangan();
            $tambahPangan->stok_masuk = $request->input('tambah_pangan');
            $tambahPangan->stok_id = $latestPangan->id;
            $tambahPangan->id_ternak = $takeId_ternak ? $takeId_ternak->id : null;
            $tambahPangan->updated_by = Auth::user()->id;

            // dd($tambahPangan);
            $tambahPangan->save();

            return redirect()->back()->with('success', 'Stok pangan berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan stok.');
        }
    }
        



    public function subtractStok(Request $request)
    {
        $request->validate(['keluar_pangan' => 'required|integer|min:0']);

        try {
            // Ambil ternak tertentu jika id_ternak disediakan
            $ternakId = $request->input('id_ternak');
            $ongoingTernak = Ternak::where('is_ongoing', 1)
            ->when($ternakId, function ($query, $ternakId) {
                return $query->where('id', $ternakId);
                })
                ->first();
                
            // Cek apakah ada ternak yang sedang berlangsung
            if (!$ongoingTernak) {
                return redirect()->back()->with('error', 'Tidak ada ternak yang sedang berlangsung. Stok tidak bisa dikurangi.');
            }

            $latestPangan = Pangan::latest('updated_at')->first();
                    
            $kurangPangan = new KurangPangan();
            $kurangPangan->stok_keluar = $request->input('keluar_pangan');
            $kurangPangan->stok_id = $latestPangan->id;
            $kurangPangan->updated_by = Auth::user()->id;

            // dd($kurangPangan);
            $kurangPangan->save();

            return redirect()->back()->with('success', 'Stok pangan berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan stok.');
        }
    }

    public function exportToPdf()
    {
        $pangan = Pangan::all();
        $pdf = PDF::loadView('pangan.export_pdf', compact('pangan'));
        return $pdf->download('pangan.pdf');
    }

    // public function exportExcel()
    // {
    //     $file_name = 'pangan_report_' . date('Y-m-d_H-i-s') . '.xlsx';
    //     return Excel::download(new \App\Exports\PanganExport, $file_name);
    // }
}
