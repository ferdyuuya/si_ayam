<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use App\Models\Ternak;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $pangan->id_ternak = $request->has('id_ternak') ? $request->input('id_ternak') : null;

        $pangan->update_pangan = now();
        $pangan->updated_by = auth()->user()->name;
        $pangan->save();

        return redirect()->back()->with('success', 'Stok pangan berhasil ditambahkan.');
    }

    public function subtractStok(Request $request)
    {
        $validatedData = $request->validate(['pengeluaran_stok' => 'required|integer|min:0']);

        if (Auth::user()->status != 0) { // 0 means false == not pengurus
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengurangi stok.');
        }

        try {
            $ongoingTernak = null;
            $ternakId = $request->has('id_ternak') ? $request->input('id_ternak') : null;

            // Prioritize specific ternak if id provided
            if ($ternakId) {
                $ongoingTernak = Ternak::where('id', $ternakId)->where('is_ongoing', 1)->first();
            }

            // If no specific ternak or not found, use any ongoing ternak
            if (!$ongoingTernak) {
                $ongoingTernak = Ternak::where('is_ongoing', 1)->first();
            }

            if (!$ongoingTernak) {
                return redirect()->back()->with('error', 'Tidak ada ternak yang sedang berlangsung. Stok tidak bisa dikurangi.');
            }

            $pangan = new Pangan();
            $pangan->pengeluaran_stok = $request->pengeluaran_stok;

            // If there previous record, start with the new pengeluaran_stok
            $latestPangan = Pangan::latest('update_pangan')->first();
            if ($latestPangan) {
                $pangan->stok_sekarang = $latestPangan->stok_sekarang - $request->pengeluaran_stok;
            } else {
                $pangan->stok_sekarang = 0;
            }

            $pangan->id_ternak = $ongoingTernak->id; // Use the retrieved ongoing ternak's id
            $pangan->update_pangan = now();
            $pangan->updated_by = auth()->user()->name;

            $pangan->save();

            return redirect()->back()->with('success', 'Stok pangan berhasil dikurangi.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Tidak ada ternak yang sedang berlangsung. Stok tidak bisa dikurangi.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengurangi stok.'); // Handle other potential errors
        }
    }
}
