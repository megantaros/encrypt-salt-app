<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tunjangan', function (Blueprint $table) {
            $table->foreign('id_slip_gaji')->references('id_slip_gaji')->on('slip_gaji')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slip_gaji', function (Blueprint $table) {
            //
        });
    }
};