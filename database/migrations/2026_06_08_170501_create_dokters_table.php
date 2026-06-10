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
        Schema::create('dokters', function (Blueprint $table) {
            $table->string('id_dokter', 5)->primary();
            $table->string('id_poli', 4);
            $table->string('nama_dokter', 100);
            $table->string('no_hp', 13);
            $table->timestamps();

            $table->foreign('id_poli')
                  ->references('id_poli')
                  ->on('polikliniks')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
