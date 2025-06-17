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
            [
                'username' => 'John mahasiswa',
                'email' => 'johnmahasiswa@gmail.com',
                'password' => Hash::make('123456789'),
                'nomor_unik' => '123456789',
                'role' => 'mahasiswa',
                'status' => 'Aktif',
            ],
            [
                'username' => 'John perusahaan',
                'email' => 'johnperusahaan@gmail.com',
                'password' => Hash::make('123456789'),
                'nomor_unik' => '11111111',
                'role' => 'perusahaan',
                'status' => 'Aktif',
            ],
            [
                'username' => 'John kaprodi',
                'email' => 'johnkaprodi@gmail.com',
                'password' => Hash::make('123456789'),
                'nomor_unik' => '22222222',
                'role' => 'kaprodi',
                'status' => 'Aktif',
            ],
            [
                'username' => 'John pimpinan',
                'email' => 'johnpimpinan@gmail.com',
                'password' => Hash::make('123456789'),
                'nomor_unik' => '33333333',
                'role' => 'pimpinan',
                'status' => 'Aktif',
            ],
            [
                'username' => 'John operator',
                'email' => 'johnoperator@gmail.com',
                'password' => Hash::make('123456789'),
                'nomor_unik' => '44444444',
                'role' => 'operator',
                'status' => 'Aktif',
            ]
        ]);
    }
}
