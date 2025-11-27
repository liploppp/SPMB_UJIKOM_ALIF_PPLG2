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
        Schema::create('pendaftar_data_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftar_id');
            $table->string('nik', 20);
            $table->string('nisn', 20);
            $table->string('nama', 120);
            $table->enum('jk', ['L', 'P']);
            $table->string('tmp_lahir', 60);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->unsignedBigInteger('wilayah_id');
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->timestamps();

            // Foreign Keys - akan ditambahkan setelah tabel pendaftars dan wilayahs dibuat
            // $table->foreign('pendaftar_id')->references('id')->on('pendaftars');
            // $table->foreign('wilayah_id')->references('id')->on('wilayahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar_data_siswas');
    }
};
