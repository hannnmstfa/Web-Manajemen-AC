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
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ac_id')->constrained('ac')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendor')->cascadeOnUpdate();
            $table->date('tgl_pengajuan');
            $table->date('tgl_selesai')->nullable();
            $table->string('permasalahan');
            $table->string('indikasi');
            $table->string('foto_petugas')->nullable();
            $table->string('foto_perbaikan')->nullable();
            $table->string('foto_pemeriksa')->nullable();
            $table->enum('status', ['pengajuan', 'proses', 'selesai'])->default('pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan');
    }
};
