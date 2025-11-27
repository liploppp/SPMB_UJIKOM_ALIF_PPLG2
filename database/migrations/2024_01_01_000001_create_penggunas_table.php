<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('no_hp', 20)->nullable();
            $table->string('password_hash');
            $table->enum('role', ['admin', 'verifikator_adm', 'keuangan', 'kepsek', 'pendaftar'])->default('pendaftar');
            $table->boolean('aktif')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penggunas');
    }
};