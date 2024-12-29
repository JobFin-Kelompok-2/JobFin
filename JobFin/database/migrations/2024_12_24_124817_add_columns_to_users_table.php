<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('alamat')->nullable()->after('email');
            $table->string('tanggal_lahir')->nullable()->after('alamat');
            $table->string('no_telpon')->nullable()->after('tanggal_lahir');
            $table->string('pendidikan_terakhir')->nullable()->after('no_telpon');
            $table->string('prodi')->nullable()->after('pendidikan_terakhir');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'alamat',
                'tanggal_lahir',
                'no_telpon',
                'pendidikan_terakhir',
                'prodi'
            ]);
        });
    }
}; 