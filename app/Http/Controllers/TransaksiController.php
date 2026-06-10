<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catatanTransaksi = Transaksi::where('user_id', auth()->id())
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        return view('admin.catatan' , compact('catatanTransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tipe' => 'required|in:pemasukan,pengeluaran',
        ]);

        // simpan ke tabel transaksi
        Transaksi::create([
            'user_id' => auth()->id(),
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'tipe' => $request->tipe,
            'tanggal' => now()->toDateString(),
        ]);
        
        return redirect()->back()->with('success', 'Transaksi Berhasil Di simpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

            $transaksi->delete();
            return redirect()->back()->with('success', 'Transaksi Berhasil Dihapus!'); 
    }
}
