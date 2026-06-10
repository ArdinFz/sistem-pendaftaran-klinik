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
        Schema::create('antreans', function (Blueprint $table) {
            $table->string('id_antrean', 6)->primary();
            $table->string('id_pendaftaran', 6);
            $table->integer('nomor_antrean');
            $table->enum('status_antrean', ['Menunggu', 'Dipanggil', 'Selesai'])->default('Menunggu');
            $table->time('waktu_antrean');
            $table->timestamps();

            $table->foreign('id_pendaftaran')
                  ->references('id_pendaftaran')
                  ->on('pendaftarans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antreans');
    }
};
