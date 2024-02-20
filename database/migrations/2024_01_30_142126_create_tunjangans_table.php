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
        Schema::create('tunjangan', function (Blueprint $table) {
            $table->bigIncrements('id_tunjangan');
            $table->unsignedBigInteger('id_slip_gaji')->nullable();
            // $table->enum('nama_tunjangan', ['Tunjangan Perjalanan', 'Tunjangan Anak', 'Tunjangan Pajak', 'Tunjangan Lainnya']);
            $table->string('nama_tunjangan');
            $table->integer('jumlah_tunjangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunjangans');
    }
};