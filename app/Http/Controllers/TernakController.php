<?php

namespace App\Http\Controllers;

use App\Models\Ternak;
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

    public function store(Request $request){
        $ternak = new Ternak;
        $ternak->ayam_mati = 0;
        $ternak->ayam_sakit = 0;
        $ternak->ayam_berhasil = 0;
        $ternak->total_ayam = 0;
        $ternak->total_awal_ayam = 0;
        $ternak->is_ongoing = true;
        $ternak->save();
        return redirect('/ternak');
    }

    public function update(Request $request, $id){
        
        $ternak = Ternak::find($id);

        if ($ternak->is_ongoing === true) {
            $ternak->ayam_mati = $request->input('ayam_mati');
            $ternak->ayam_sakit = $request->input('ayam_sakit');
            $ternak->ayam_berhasil = $request->input('ayam_berhasil');
            $ternak->total_ayam = $request->input('total_ayam');
            $ternak->total_awal_ayam = $request->input('total_awal_ayam');
            $ternak->is_ongoing = false; //Phase Ternak is done
            $ternak->save();
        }
    }
}
