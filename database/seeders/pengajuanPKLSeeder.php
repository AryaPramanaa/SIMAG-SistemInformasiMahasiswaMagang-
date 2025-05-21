<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class pengajuanPKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengajuanPKLs')->insert([
            'mahasiswa_id' => 1, // Make sure this ID exists in mahasiswas table
            'perusahaan_id' => 1, // Make sure this ID exists in perusahaans table
            'tanggal_pengajuan' => Carbon::now(),
            'status' => 'Pending',
            'divisi_pilihan' => 'IT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
    }
}
