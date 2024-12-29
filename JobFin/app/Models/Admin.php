<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alamat',
        'tanggal_lahir',
        'no_telpon',
        'email',
        'password',
        'role',
        'pendidikan_terakhir'
    ];

    protected $hidden = [
        'password',
    ];
}