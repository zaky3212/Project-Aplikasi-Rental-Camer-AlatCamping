<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            
            // Murni tabel barang aja, tanpa foreign key kategori
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('harga_sewa'); 
            $table->integer('stok');
            $table->string('gambar')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};