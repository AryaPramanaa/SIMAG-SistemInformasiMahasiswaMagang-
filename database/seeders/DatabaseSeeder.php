<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSedder::class);
        $this->call(Prodi::class);
        // $this->call(Perusahaan::class);
        // $this->call(PembimbingIndustri::class);
        $this->call(Mahasiswa::class);
       
        
        // $this->call(pengajuanPKLSeeder::class);
    }
}
