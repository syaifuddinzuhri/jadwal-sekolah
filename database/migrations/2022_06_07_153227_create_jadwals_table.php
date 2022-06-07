<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_akademik_id');
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->integer('urutan')->default(0);
            $table->foreign('tahun_akademik_id')->references('id')->on('tahun_akademiks')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onDelete('RESTRICT')->onUpdate('CASCADE');
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
        Schema::dropIfExists('jadwals');
    }
}
