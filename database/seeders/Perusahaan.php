<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Perusahaan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaans')->insert([
            'nama_perusahaan' => 'PT. Contoh perusahaan',
            'alamat' => 'Jl. kebajikan No. 123, Jakarta',
            'kontak' => '0123-456',
            'bidang_usaha' => 'Teknik Mesin',
            'status_kerjasama' => 'Aktif',
        ]);

        // Contoh update semua perusahaan agar user_id = 2
        DB::table('perusahaans')->update(['user_id' => 2]);
    }
}
