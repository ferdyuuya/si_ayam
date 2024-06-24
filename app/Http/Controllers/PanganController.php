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
        // Validate input (ensure it's a positive integer)
        $validatedData = $request->validate(['pemasukan_stok' => 'required|integer|min:0']);

        // Only admin can add stock
        if (Auth::user()->status != 0) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menambahkan stok.');
        }

        // Fetch the latest Pangan record based on update_pangan
        $latestPangan = Pangan::latest('update_pangan')->first();

        // Initialize new Pangan record
        $pangan = new Pangan();
        $pangan->pemasukan_stok = $request->pemasukan_stok;

        // If a latest record exists, set stok_sekarang based on the previous value
        if ($latestPangan) {
            $pangan->stok_sekarang = $latestPangan->stok_sekarang + $request->pemasukan_stok;
        } else {
            // If no previous record, start with the new pemasukan_stok
            $pangan->stok_sekarang = $request->pemasukan_stok;
        }

        $pangan->update_pangan = now();
        $pangan->updated_by = auth()->user()->name;
        $pangan->save();

        return redirect()->back()->with('success', 'Stok pangan berhasil ditambahkan.');
    }

    public function subtractStock(Request $request)
    {
        // Validate input (ensure it's a positive integer)
        $request->validate(['pengeluaran_stok' => 'required|integer|min:0']);

        $pangan = Pangan::latest('update_pangan')->firstOrFail(); // Get the latest record

        // Check if stock is sufficient and there's an ongoing ternak (if applicable)
        if ($pangan->stok_sekarang >= $request->pengeluaran_stok) {
            // Optional: Check if there's an ongoing ternak if you have the relationship set up
            // if (optional($pangan->ternak)->is_ongoing) {
            $pangan->pengeluaran_stok = $request->pengeluaran_stok;
            $pangan->stok_sekarang -= $request->pengeluaran_stok; // Subtract from existing stock
            $pangan->update_pangan = now();
            $pangan->updated_by = auth()->user()->id;
            $pangan->save();
            return redirect()->back()->with('success', 'Stok pangan berhasil dikurangi.');
            // } else {
            //     return redirect()->back()->with('error', 'Tidak ada ternak yang sedang berlangsung.');
            // }
        } else {
            return redirect()->back()->with('error', 'Stok pangan tidak mencukupi.');
        }
    }
}
