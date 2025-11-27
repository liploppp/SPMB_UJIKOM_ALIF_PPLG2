<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->decimal('jumlah', 10, 2);
            $table->enum('metode_pembayaran', ['transfer', 'cash', 'qris']);
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamp('tanggal_bayar');
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamps();
            
            $table->foreign('verified_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};