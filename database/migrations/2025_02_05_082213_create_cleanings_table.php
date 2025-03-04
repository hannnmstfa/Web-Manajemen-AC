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
        Schema::create('cleaning', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ac_id')->constrained('ac')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('vendor_id')->constrained('vendor')->cascadeOnUpdate();
            $table->date('tgl_planing');
            $table->date('tgl_actual')->nullable();
            $table->string('foto_petugas')->nullable();
            $table->string('foto_cleaning')->nullable();
            $table->string('foto_pemeriksa')->nullable();
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning');
    }
};
