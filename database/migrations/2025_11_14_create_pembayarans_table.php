<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftar_id');
            $table->string('kode_pembayaran', 20)->unique();
            $table->decimal('jumlah', 12, 2);
            $table->enum('status', ['BELUM_BAYAR', 'MENUNGGU_VERIFIKASI', 'LUNAS', 'DITOLAK']);
            $table->string('bukti_transfer')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->unsignedBigInteger('verifikator_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};