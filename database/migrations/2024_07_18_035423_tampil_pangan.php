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
        Schema::create('tampil_pangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pangan')->constrained('pangan')->onDelete('cascade');
            $table->foreignId('id_operation_pangan')->constrained('operation_pangan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tampil_pangan');
    }
};
