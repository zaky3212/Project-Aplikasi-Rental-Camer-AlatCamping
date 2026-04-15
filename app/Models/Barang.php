<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    // Kolom yang diizinkan untuk diisi, tanpa kategori_id
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga_sewa',
        'stok',
        'gambar',
    ];
}