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
        Schema::create('log_aktifitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('aksi', 100);
            $table->string('objek', 100);
            $table->json('objek_data')->nullable();
            $table->datetime('waktu');
            $table->string('ip', 45);
            $table->timestamps();

            // Foreign Key - akan ditambahkan setelah tabel penggunas dibuat
            // $table->foreign('user_id')->references('id')->on('penggunas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktifitas');
    }
};
