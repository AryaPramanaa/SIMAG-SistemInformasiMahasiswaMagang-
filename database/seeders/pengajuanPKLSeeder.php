<?php

namespace Database\Seeders;

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
            'nama' => 'John lenon2',
            'perusahaan' => 'PT.Suka suka',
            'status' => 'success',
           
        ]); 
    }
}
