<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = ['user_id', 'deskripsi', 'jumlah', 'tipe', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];

    //relasi ke user 
    // transaksi ini milik 1 user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // untuk waktu
    public function getWaktuAttribute()
    {
        $menit = $this->created_at->diffInMinutes(now());
        $jam   = $this->created_at->diffInHours(now());
        $hari  = $this->created_at->diffInDays(now());

        if ($menit < 60) {
            return $menit . ' Menit Yang Lalu';
        } elseif ($jam < 24) {
            return $jam . ' Jam Yang Lalu';
        } else {
            return $hari . ' Hari Yang Lalu';
        }
    }
}
