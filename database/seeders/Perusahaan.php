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
            'nama_perusahaan' => 'PT. test',
            'alamat' => 'Jl. Contoh No. 123, Jakarta',
            'kontak' => '021-56778',
            'bidang_usaha' => 'Teknik Elektroo90',
            'status_kerjasama' => 'Aktif',
        ]);
    }
}
