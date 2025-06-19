<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Prodi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodis')->insert([
            'nama_prodi' => 'Teknik Informatika',
            'nama_kaprodi' => 'Dr. John Doe',
            'jurusan' => 'Teknolofi Informasi',
        ]);
    }
}
