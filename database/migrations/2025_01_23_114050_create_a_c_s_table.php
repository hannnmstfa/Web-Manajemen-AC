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
        Schema::create('ac', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inv');
            $table->date('tgl_pemasangan');
            $table->string('nama_ac');
            $table->foreignId('ruangan_id')->constrained('ruangan')->cascadeOnDelete();
            $table->integer('plant');
            $table->integer('pk');
            $table->longText('spesifikasi');
            $table->string('tempat_beli')->nullable();
            $table->string('foto_nota')->nullable();
            $table->string('foto_petugas')->nullable();
            $table->string('foto_pemasangan')->nullable();
            $table->string('foto_pemeriksa')->nullable();
            $table->string('foto_indoor')->nullable();
            $table->string('foto_outdoor')->nullable();
            $table->enum('status', ['normal', 'perbaikan', 'rusak'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ac');
    }
};
