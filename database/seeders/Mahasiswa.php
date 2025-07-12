<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswas')->insert([
            'nim' => '234567890',
            'nama' => 'John Doe',
            'email' => 'johnmahasiswa@gmail.com',
            'no_hp' => '081234567890',
            'status_aktif' => 'Aktif',
            'alamat' => 'Jl. Contoh No. 123',
            'semester' => '5',
            'ktm' => null,
            'prodi_id' => 1,
            'user_id' => 1  // This links to the first user (John mahasiswa)
        ]);

        DB::table('mahasiswas')->insert([
            'nim' => '234567891',
            'nama' => 'Jane Smith',
            'email' => 'janemahasiswa@gmail.com',
            'no_hp' => '081234567891',
            'status_aktif' => 'Aktif',
            'alamat' => 'Jl. Mawar No. 45',
            'semester' => '5',
            'ktm' => null,
            'prodi_id' => 1,
            'user_id' => 6
        ]);
    }
}
