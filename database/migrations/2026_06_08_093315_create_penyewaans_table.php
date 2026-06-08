<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('kode_transaksi')->unique(); // Contoh: LNS-20260608-001
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('total_harga');

            $table->enum('status', ['Unpaid', 'Paid', 'Disewa', 'Selesai', 'Batal'])->default('Unpaid');

            $table->integer('denda')->default(0);
            $table->text('alasan_denda')->nullable();

            $table->string('snap_token')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
