<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller 
{
    public function index() {
        $user = auth()->user();

        // hitung bulan sekarang 
        $pemasukan = Transaksi::where('user_id', $user->id)
            ->where('tipe', 'pemasukan')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        $pengeluaran = Transaksi::where('user_id', $user->id)
            ->where('tipe', 'pengeluaran')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        // hitung total saldo sekarang

        $totalMasuk = Transaksi::where('user_id', $user->id)
            ->where('tipe', 'pemasukan')->sum('jumlah');

        $totalKeluar = Transaksi::where('user_id', $user->id)
            ->where('tipe', 'pengeluaran')->sum('jumlah');
        
        // hitung 
        $saldo = $totalMasuk - $totalKeluar;

        $transaksiTerbaru = Transaksi::where('user_id', $user->id)
            ->latest() //urutan terbaru
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pemasukan',
            'pengeluaran',
            'saldo',
            'transaksiTerbaru'
        ));
    }
}