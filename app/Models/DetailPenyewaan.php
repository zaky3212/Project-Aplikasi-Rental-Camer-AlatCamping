<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    use HasFactory;

    // Kasih tau Laravel nama tabel aslinya
    protected $table = 'detail_penyewaans';
    
    // Buka semua kolom biar bisa diisi (kecuali ID)
    protected $guarded = ['id'];

    // Relasi balik ke transaksi induk (Penyewaan)
    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }

    // Relasi ke barang yang disewa
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}