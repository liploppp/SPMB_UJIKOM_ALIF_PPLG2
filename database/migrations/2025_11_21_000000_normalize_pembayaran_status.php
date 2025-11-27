<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Normalize all status values to lowercase
        DB::table('pembayarans')->update([
            'status' => DB::raw('LOWER(status)')
        ]);
    }

    public function down(): void
    {
        // No need to revert
    }
};
