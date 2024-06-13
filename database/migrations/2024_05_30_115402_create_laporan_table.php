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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ternak');
            $table->unsignedBigInteger('id_pangan');
            $table->unsignedBigInteger('id_user');
            $table->integer('ayam_mati')->default(0);
            $table->integer('ayam_hidup')->default(0);
            $table->integer('ayam_sakit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
