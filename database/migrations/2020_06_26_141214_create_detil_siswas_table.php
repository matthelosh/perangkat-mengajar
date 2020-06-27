<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('siswa_id', 30);
            $table->string('semester', 10);
            $table->string('tb', 30);
            $table->string('bb', 30);
            $table->string('pendengaran', 30);
            $table->string('penglihatan', 30);
            $table->string('gigi', 30);
            $table->string('fisik_lain', 30);
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
        Schema::dropIfExists('detil_siswas');
    }
}
