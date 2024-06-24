<?php

namespace App\Http\Controllers;

use App\Models\Ternak;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class TernakController extends Controller
{
    public function index() //for view ternak
    {
        return view('ternak.index', [
            'ternak' => Ternak::all(),
        ]);
    }

    public function add() //for view add ternak
    {
        return view('ternak.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total_awal_ayam' => 'required|integer|min:2000',
        ]);

        $ternak = new Ternak;
        $ternak->ayam_mati = 0;
        $ternak->ayam_sakit = 0;
        $ternak->ayam_berhasil = 0;
        $ternak->total_ayam = 0;
        $ternak->total_awal_ayam = $validatedData['total_awal_ayam'];
        $ternak->is_ongoing = true;
        $ternak->save();
        return redirect('/ternak');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ayam_mati' => 'required|integer|min:0',
            'ayam_sakit' => 'required|integer|min:0',
            'ayam_berhasil' => 'required|integer|min:0',
        ]);

        $ternak = Ternak::findOrFail($id); // Use findOrFail for automatic 404 if not found

        if ($ternak->is_ongoing) {
            $ternak->fill($validatedData);

            // Calculate total_ayam
            $ternak->total_ayam = $ternak->ayam_mati + $ternak->ayam_sakit + $ternak->ayam_berhasil;

            // Calculate total_awal_ayam
            $ternak->total_awal_ayam = $ternak->total_awal_ayam - $ternak->total_ayam;

            $ternak->is_ongoing = false;

            $ternak->save();

            return redirect()->back()->with('success', 'Data ternak berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Masa ternak sudah berakhir.');
        }
    }
}
