<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->updateOrInsert(
            ['email' => 'suherman@x.com'], // kondisi pencarian
            [
                "name" => "Suherman",
                "alamat" => "Jalan Contoh No. 123",
                "tanggal_lahir" => "1990-01-01",
                "no_telpon" => "081234567890",
                "pendidikan_terakhir" => "S1",
                "prodi" => "Teknik Informatika",
                "password" => Hash::make("qwe123")
            ]
        );
    }
}
