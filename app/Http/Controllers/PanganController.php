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


        // Jika tidak ada stok sebelumnya, maka stok sekarang adalah stok yang dimasukkan
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
        $validatedData = $request->validate([
            'pengeluaran_stok' => 'required|integer|min:0'
        ]);

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

            // Ambil stok terbaru dari catatan terakhir
            $latestPangan = Pangan::latest('update_pangan')->first();
            $currentStock = $latestPangan ? $latestPangan->stok_sekarang : 0;

            // Buat record Pangan baru
            $pangan = new Pangan();
            $pangan->pengeluaran_stok = $validatedData['pengeluaran_stok'];
            $pangan->stok_sekarang = $currentStock - $validatedData['pengeluaran_stok'];

            // Tetapkan atribut lain
            $pangan->id_ternak = $ongoingTernak->id;
            $pangan->update_pangan = now();
            $pangan->updated_by = Auth::user()->name;

            // Simpan record Pangan baru
            $pangan->save();

            return redirect()->back()->with('success', 'Stok pangan berhasil dikurangi.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengurangi stok.');
        }
    }
}
