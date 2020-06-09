<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaKDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peta_kds', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat', 2);
            $table->string('mapel_id', 10);
            $table->string('bab_id', 30);
            $table->string('ki_id', 10);
            $table->string('kd_id', 10);
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
        Schema::dropIfExists('peta_k_d_s');
    }
}
