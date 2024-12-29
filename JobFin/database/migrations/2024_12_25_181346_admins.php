<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alamat');
            $table->string('tanggal_lahir');
            $table->bigInteger('no_telpon');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('pendidikan_terakhir');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
};