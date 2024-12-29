<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengelolaSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengelola')->insert([
            'name' => 'pengelola',
            'alamat' => 'anonymous',
            'tanggal_lahir' => '25 agustus 2004',
            'no_telpon' => 628153923512,
            'email' => 'pengelola@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pengelola',
            'pendidikan_terakhir' => 'S3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}