<?php

namespace App\Http\Controllers;

use App\Models\Pangan;
use Illuminate\Http\Request;

class PanganController extends Controller
{
    public function index(){
        return view('pangan.index', [
            'pangan' => Pangan::all(),
        ]);
    }
    public function add_index(){
        return view('pangan.input_pangan');
    }
}