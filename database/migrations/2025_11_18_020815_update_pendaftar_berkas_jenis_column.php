<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Gunakan raw SQL karena Laravel tidak bisa mengubah enum dengan baik
        DB::statement('ALTER TABLE pendaftar_berkas MODIFY jenis VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pendaftar_berkas MODIFY jenis ENUM('IJAZAH', 'RAPOR', 'KIP', 'KKS', 'AKTA', 'KK', 'LAINNYA') NOT NULL");
    }
};