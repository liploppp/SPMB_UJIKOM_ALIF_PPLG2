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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->datetime('tanggal_daftar');
            $table->string('no_pendaftaran', 20)->unique();
            $table->unsignedBigInteger('gelombang_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->enum('status', ['SUBMIT', 'VERIFIKASI', 'DITERIMA', 'DITOLAK']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
