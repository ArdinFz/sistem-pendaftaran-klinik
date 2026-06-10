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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->string('id_pendaftaran');
            $table->date('tanggal');
            $table->string('nomor_antrean');
            $table->string('hari');
            $table->string('jam');
            $table->string('nik');
            $table->string('email');
            $table->string('no_hp');
            $table->string('pasien');
            $table->string('dokter');
            $table->string('poli');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->text('keluhan');
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
