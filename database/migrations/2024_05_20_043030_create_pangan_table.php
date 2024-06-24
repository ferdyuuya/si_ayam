<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pangan', function (Blueprint $table) {
            $table->id();
            $table->integer('pengeluaran_stok')->default(0);
            $table->integer('stok_sekarang')->default(0);
            $table->integer('pemasukan_stok')->default(0);
            $table->date('update_pangan');
            $table->string('updated_by');
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
        Schema::dropIfExists('pangan');
    }
}
