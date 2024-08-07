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
        Schema::table('laporan', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_ternak')->references('id')->on('ternak')->onDelete('cascade');
            $table->foreign('id_pangan')->references('id')->on('pangan')->onDelete('cascade');
        });
        Schema::table('pangan', function (Blueprint $table) {
            $table->foreign('id_ternak')->references('id')->on('ternak')->onDelete('cascade');
            $table->foreign('id_operasi')->references('id')->on('operation_pangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
