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
        Schema::create('tambah_pangan', function (Blueprint $table) {
            $table->id();
            $table->integer('stok_masuk');
            $table->unsignedBigInteger('stok_id');
            $table->unsignedBigInteger('id_ternak')->nullable();
            $table->foreign('stok_id')->references('id')->on('pangan');
            $table->foreign('id_ternak')->references('id')->on('ternak');
            $table->string('updated_by');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER update_stok_on_tambah_pangan
            AFTER INSERT ON tambah_pangan
            FOR EACH ROW
            BEGIN
            INSERT INTO pangan (id_ternak, stok_sekarang, updated_by, created_at, updated_at)
            SELECT id_ternak, stok_sekarang + NEW.stok_masuk, NEW.updated_by, NOW(), NOW()
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
        Schema::dropIfExists('tambah');
        DB::unprepared('DROP TRIGGER update_stok_on_tambah');
    }
};
