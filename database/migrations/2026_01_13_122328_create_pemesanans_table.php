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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pemesanan')->unique();
            $table->foreignId('paket_tour_id')
                  ->constrained('packages')
                  ->onDelete('cascade');
            $table->string('jadwal');
            $table->string('nama_pemesan');
            $table->string('no_hp');
            $table->integer('jumlah_peserta');
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('menunggu');

            $table->decimal('total_harga', 12, 2);
            $table->text('image_bukti')->nullable();
            $table->enum('metode_pembayaran', ['transfer', 'cash'])->nullable();
            $table->enum('status_pembayaran', ['pending', 'lunas', 'batal'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
