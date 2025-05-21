<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembimbingIndustri extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembimbingIndustris')->insert([
            'nama_pembimbing' => 'John Doe',
            'jabatan' => 'Dekan',
            'kontak' => '081234567890',
            'email' => 'john.doe@example.com',
            'perusahaan_id' => 1,
        ]);
    }
}
