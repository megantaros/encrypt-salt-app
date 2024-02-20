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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->bigIncrements('id_karyawan');
            $table->string('nama_karyawan');
            $table->unsignedBigInteger('id_jabatan');
            // $table->unsignedBigInteger('id_slip_gaji')->nullable();
            $table->string('nik');
            $table->string('password');
            $table->string('salt')->nullable();
            $table->string('alamat');
            $table->string('ktp');
            $table->string('kk');
            $table->string('no_telpon');
            $table->string('nip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};