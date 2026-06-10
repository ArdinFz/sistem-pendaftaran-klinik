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
            $table->string('id_pendaftaran', 6)->primary();
            $table->string('id_user', 6);
            $table->unsignedInteger('id_jadwal');
            $table->dateTime('tanggal_daftar');
            $table->text('keluhan');
            $table->enum('status', ['Menunggu', 'Dipanggil', 'Selesai'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id_pasien')
                  ->on('pasiens')
                  ->onDelete('cascade');

            $table->foreign('id_jadwal')
                  ->references('id_jadwal')
                  ->on('jadwal_dokters')
                  ->onDelete('cascade');
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
