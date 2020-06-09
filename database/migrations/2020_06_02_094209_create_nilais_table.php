<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->string('kompetensi', 30);
            $table->string('format', 60);
            $table->string('periode', 60);
            $table->string('semester', 60);
            $table->string('tema_id', 60);
            $table->string('subtema_id', 60);
            $table->string('pembelajaran_id', 60);
            $table->string('kd_id', 60);
            $table->string('mapel_id', 60);
            $table->string('siswa_id', 60);
            $table->double('nilai', 2,2);
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
        Schema::dropIfExists('nilais');
    }
}
