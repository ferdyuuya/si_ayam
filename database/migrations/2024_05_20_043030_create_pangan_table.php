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
            $table->date('tanggal');
            $table->integer('pengeluaran_harian')->default(0);
            $table->integer('stok_sekarang')->default(0);
            $table->integer('pemasukan_bulanan')->default(0);
            $table->integer('update_pangan')->default(0);
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
