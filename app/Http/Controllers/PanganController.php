<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use App\Models\Ternak;
use App\Models\TambahPangan;
use App\Models\Showpangan;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\PanganExport;
use App\Models\KurangPangan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PanganController extends Controller
{
    public function index()
    {
        // Misalkan $role diambil dari status user yang sedang login
        $role = Auth::user()->status ? 1 : 0;

        // Mengambil semua ternak, pangan, dan operasi pangan
        $pangans = Pangan::all();
        $operationPangan = TambahPangan::all();

        // Mengambil data showpangans dengan relasinya
        $showpangans = Showpangan::with(['pangan', 'tambahPangan'])->get();

        // Menghitung hari sejak ternak terakhir dimulai
        $ternak = Ternak::where('is_ongoing', 1)->orderByDesc('created_at')->first();
        $daysSinceTernakStarted = $ternak ? Carbon::parse($ternak->created_at)->diffInDays() : 0;

        // Counter untuk nomor urutan
        $counter = 1;

        // Return data or redirect as needed
        return view('pangan.index', compact('role', 'pangans', 'showpangans', 'daysSinceTernakStarted', 'counter'));
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
            $tambahPangan->stok_keluar = 0;
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
            // $ternakId = $request->input('id_ternak'); 
            $ongoingTernak = Ternak::where('is_ongoing', 1)->first();

            // Cek apakah ada ternak yang sedang berlangsung
            if (!$ongoingTernak) {
                return redirect()->back()->with('error', 'Tidak ada ternak yang sedang berlangsung. Stok tidak bisa dikurangi.');
            }

            $latestPangan = Pangan::latest('updated_at')->first();

            $kurangPangan = new TambahPangan();
            $kurangPangan->stok_masuk = 0;
            $kurangPangan->stok_keluar = $request->input('keluar_pangan');
            $kurangPangan->stok_id = $latestPangan->id;
            $kurangPangan->id_ternak = $ongoingTernak->id;
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
