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
        Schema::create('laporanMahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuanPKL_id')->constrained('pengajuanPKLs')->onDelete('cascade');
            $table->foreignId('pembimbingIndustri_id')->constrained('pembimbingIndustris')->onDelete('cascade');
            $table->foreignId('pembimbingAkademik_id')->constrained('pembimbing_akademik')->onDelete('cascade');
            $table->date('tanggal_laporan');
            $table->text('isi_laporan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporanMahasiswas');
    }
};
