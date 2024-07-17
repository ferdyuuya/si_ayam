<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kurang_pangan', function (Blueprint $table) {
            $table->id();
            $table->integer('stok_keluar')->unsigned();
            $table->unsignedBigInteger('stok_id');
            $table->foreign('stok_id')->references('id')->on('pangan');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps(); 
            });

       DB::unprepared('
            CREATE TRIGGER update_stok_on_kurang_pangan
            AFTER INSERT ON kurang_pangan
            FOR EACH ROW
            BEGIN
            INSERT INTO pangan (id_ternak, stok_sekarang, updated_by, created_at, updated_at)
            SELECT id_ternak, stok_sekarang - NEW.stok_keluar, NEW.updated_by, NOW(), NOW()
            FROM pangan
            WHERE id = NEW.stok_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kurang');
        DB::unprepared('DROP TRIGGER update_stok_on_kurang');
    }
};
