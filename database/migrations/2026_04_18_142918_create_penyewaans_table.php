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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            
            // Nama Penyewa
            $table->string('nama_penyewa');
            
            // Relasi ke tabel barang dan kategori
            // Pastikan tabel barangs dan kategoris sudah ada sebelumnya
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            
            // Data Kontak & Waktu
            $table->string('no_hp');
            $table->date('tanggal_sewa');
            $table->integer('lama_sewa'); // Dalam satuan hari (sesuai input angka)
            
            // Keuangan
            $table->decimal('total_harga', 12, 2);
            
            // Status (Sesuai mockup ada tombol 'Kembali' berwarna hijau)
            // default 'disewa', bisa berubah jadi 'kembali'
            $table->enum('status', ['disewa', 'kembali'])->default('disewa');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};