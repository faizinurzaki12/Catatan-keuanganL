<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class AktivitasController extends Controller 
{
    public function index() {
        // ambil semua transaksi dari user 
        $aktivitas = Transaksi::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('aktivitas', compact('aktivitas'));
    }
}