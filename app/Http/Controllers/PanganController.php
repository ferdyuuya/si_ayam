<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use App\Models\Ternak;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PanganController extends Controller
{
    public function index()
    {
        return view('pangan.index', [
            'pangan' => Pangan::all(),
        ]);
    }
    public function add()
    {
        return view('pangan.input_pangan');
    }

    public function addStok(Request $request)
    {
        $validatedData = $request->validate(['pemasukan_stok' => 'required|integer|min:0']);

        if (Auth::user()->status != 0) { // 0 means false == not pengurus
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menambahkan stok.');
        }

        $latestPangan = Pangan::latest('update_pangan')->first();
        $pangan = new Pangan();
        $pangan->pemasukan_stok = $request->pemasukan_stok;


        // If there previous record, start with the new pemasukan_stok
        if ($latestPangan) {
            $pangan->stok_sekarang = $latestPangan->stok_sekarang + $request->pemasukan_stok;
        } else {
            $pangan->stok_sekarang = $request->pemasukan_stok;
        }

        $pangan->update_pangan = now();
        $pangan->updated_by = auth()->user()->name;
        $pangan->save();

        return redirect()->back()->with('success', 'Stok pangan berhasil ditambahkan.');
    }

    public function subtractStock(Request $request)
    {
        $request->validate(['pengeluaran_stok' => 'required|integer|min:0']);

        $pangan = Pangan::latest('update_pangan')->firstOrFail(); // Get the latest record

        if ($pangan->stok_sekarang >= $request->pengeluaran_stok) {
            if (optional($pangan->ternak)->is_ongoing == 1) {
                $pangan->pengeluaran_stok = $request->pengeluaran_stok;
                $pangan->stok_sekarang -= $request->pengeluaran_stok; // Subtract from existing stock
                $pangan->update_pangan = now();
                $pangan->updated_by = auth()->user()->id;
                $pangan->save();
                return redirect()->back()->with('success', 'Stok pangan berhasil dikurangi.');
            } else {
                return redirect()->back()->with('error', 'Tidak ada ternak yang sedang berlangsung.');
            }
        } else {
            return redirect()->back()->with('error', 'Stok pangan tidak mencukupi.');
        }
    }
}
