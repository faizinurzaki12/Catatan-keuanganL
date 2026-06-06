<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            
            //relasi ke tabel users
            $table->foreignId('user_id')
                   ->constrained('users')
                   ->onDelete('cascade');
            // onDelete cascade = kalau user dihapus
            // maka catatan transaksi akan ikut terhapus juga
            $table->string('deskripsi');
            $table->unsignedBigInteger('jumlah');
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->date('tanggal');
            $table->timestamps();
            // timestamps() otomatis buat:
            // created_at → untuk hitung "36 menit yang lalu"
            // updated_at → kapan terakhir diupdate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
