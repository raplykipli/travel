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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buses_id')
                ->constrained('buses')
                ->onDelete('cascade');
            $table->string('nama_paket');
            $table->string('destinasi');
            $table->integer('durasi')->nullable();
            $table->decimal('harga', 12, 2)->nullable();
            $table->integer('max_peserta')->nullable();
            $table->text('fasilitas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->json('jadwal')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
