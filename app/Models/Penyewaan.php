<?php

namespace App\Models; // <--- Pastikan baris ini ada

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaans'; // Nama tabel di database

    protected $fillable = [
        'nama_penyewa', 
        'barang_id', 
        'no_hp', 
        'tanggal_sewa', 
        'tanggal_kembali', 
        'lama_sewa', 
        'total_harga', 
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}