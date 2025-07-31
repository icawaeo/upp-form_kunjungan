<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->string('instansi')->after('nama_lengkap');
            $table->dropColumn('jam_kembali');
            $table->string('nomor_kendaraan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn('instansi');
            $table->time('jam_kembali')->after('jam_datang');
            $table->string('nomor_kendaraan')->nullable(false)->change();
        });
    }
};