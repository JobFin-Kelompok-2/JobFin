<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'alamat' => 'anonymous',
            'tanggal_lahir' => '25 september 2004',
            'no_telpon' => 628138523522,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'pendidikan_terakhir' => 'S3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}