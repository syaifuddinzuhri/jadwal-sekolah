<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_akademik_id');
            $table->string('kode_mapel')->unique();
            $table->string('nama_mapel');
            $table->integer('total_jam')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('tahun_akademik_id')->references('id')->on('tahun_akademiks')->onDelete('RESTRICT')->onUpdate('CASCADE');
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
        Schema::dropIfExists('mata_pelajarans');
    }
}
