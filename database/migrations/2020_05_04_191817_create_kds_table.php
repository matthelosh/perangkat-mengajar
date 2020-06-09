<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kds', function (Blueprint $table) {
            $table->id();
            $table->string('sekolah_id', 30)->nullable();
            $table->string('tingkat', 3);
            $table->string('mapel_id', 3);
            $table->string('ki_id', 5);
            $table->string('kode_kd', 5);
            $table->string('teks_kd', 191);
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
        Schema::dropIfExists('kds');
    }
}
