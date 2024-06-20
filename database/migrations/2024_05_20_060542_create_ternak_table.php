<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTernakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ternak', function (Blueprint $table) {
            $table->id();
            $table->integer('ayam_mati')->default(0);
            $table->integer('ayam_sakit')->default(0);
            $table->integer('ayam_berhasil')->default(0);
            $table->integer('total_ayam')->default(0);
            $table->integer('total_awal_ayam')->default(0);
            $table->boolean('is_ongoing')->default(true); //Set phase ternak is_ongoing = true means the phase is still ongoing
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ternak');
    }
}
