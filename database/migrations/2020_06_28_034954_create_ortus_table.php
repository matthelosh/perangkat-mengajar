<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrtusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ortus', function (Blueprint $table) {
            $table->id();
            $table->string('siswa_id', 20);
            $table->string('nama_ayah', 40);
            $table->string('nama_ibu', 40);
            $table->string('job_ayah', 40);
            $table->string('job_ibu', 40);
            $table->string('nama_wali', 40)->nullable();
            $table->string('job_wali', 60)->nullable();
            $table->string('alamat_wali', 191)->nullable();
            $table->string('hp_ortu', 191)->nullable();
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
        Schema::dropIfExists('ortus');
    }
}
