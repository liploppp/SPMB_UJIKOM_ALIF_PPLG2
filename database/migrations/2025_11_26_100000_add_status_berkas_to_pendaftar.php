<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->enum('status_berkas', ['SUBMIT', 'VERIFIKASI', 'DITERIMA', 'DITOLAK'])->default('SUBMIT')->after('status');
            $table->text('alasan_tolak_berkas')->nullable()->after('status_berkas');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn(['status_berkas', 'alasan_tolak_berkas']);
        });
    }
};
