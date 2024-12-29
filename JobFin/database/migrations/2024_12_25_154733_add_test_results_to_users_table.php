<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tes_teknis')->nullable();
            $table->string('tes_bakat')->nullable();
            $table->string('penempatan_kerja')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tes_teknis', 'tes_bakat', 'penempatan_kerja']);
        });
    }
}; 