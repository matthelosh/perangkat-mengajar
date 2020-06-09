<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemetaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemetaans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tingkat', 3);
            $table->string('mapel_id', 10);
            $table->string('subtema_id', 10);
            $table->string('kd_id', 10);
            $table->string('semester_id', 10)->nullable();
            $table->string('keyword', 150);
            $table->string('sekolah_id', 30);
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
        Schema::dropIfExists('pemetaans');
    }
}
