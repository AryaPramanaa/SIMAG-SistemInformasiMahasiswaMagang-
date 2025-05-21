<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'John Smith',
            'email' => 'johnsmith123@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'mahasiswa',
            'status' => 'Aktif',
        ]);

    }
}
