<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            if (!Schema::hasColumn('pembayarans', 'pendaftar_id')) {
                $table->unsignedBigInteger('pendaftar_id')->after('id');
            }
            if (!Schema::hasColumn('pembayarans', 'nominal')) {
                $table->decimal('nominal', 10, 0)->after('pendaftar_id');
            }
            if (!Schema::hasColumn('pembayarans', 'tanggal_transfer')) {
                $table->date('tanggal_transfer')->after('nominal');
            }
            if (!Schema::hasColumn('pembayarans', 'bukti_pembayaran')) {
                $table->string('bukti_pembayaran')->after('tanggal_transfer');
            }
            if (!Schema::hasColumn('pembayarans', 'catatan')) {
                $table->text('catatan')->nullable()->after('bukti_pembayaran');
            }
            if (!Schema::hasColumn('pembayarans', 'status')) {
                $table->enum('status', ['PENDING', 'VERIFIED', 'REJECTED'])->default('PENDING')->after('catatan');
            }
            if (!Schema::hasColumn('pembayarans', 'tanggal_upload')) {
                $table->datetime('tanggal_upload')->after('status');
            }
            if (!Schema::hasColumn('pembayarans', 'verified_at')) {
                $table->datetime('verified_at')->nullable()->after('tanggal_upload');
            }
            if (!Schema::hasColumn('pembayarans', 'verified_by')) {
                $table->unsignedBigInteger('verified_by')->nullable()->after('verified_at');
            }
        });
    }

    public function down()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn([
                'pendaftar_id', 'nominal', 'tanggal_transfer', 
                'bukti_pembayaran', 'catatan', 'status', 
                'tanggal_upload', 'verified_at', 'verified_by'
            ]);
        });
    }
};