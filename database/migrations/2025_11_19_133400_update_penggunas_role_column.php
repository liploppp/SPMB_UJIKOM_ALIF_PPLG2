<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->string('role', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->enum('role', ['pendaftar', 'admin', 'verifikator_adm', 'keuangan', 'kepsek'])->change();
        });
    }
};