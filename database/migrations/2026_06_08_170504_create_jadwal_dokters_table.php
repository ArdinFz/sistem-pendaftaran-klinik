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
        Schema::create('jadwal_dokters', function (Blueprint $table) {
            $table->unsignedInteger('id_jadwal')->autoIncrement();
            $table->string('id_dokter', 5);
            $table->dateTime('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedInteger('kuota');
            $table->timestamps();

            $table->foreign('id_dokter')
                  ->references('id_dokter')
                  ->on('dokters')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokters');
    }
};
