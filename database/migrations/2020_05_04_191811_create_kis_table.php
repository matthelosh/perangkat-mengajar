<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kis', function (Blueprint $table) {
            $table->id();
            $table->string('sekolah_id', 30)->nullable();
            $table->string('tingkat', 3);
            $table->string('mapel_id', 60);
            $table->string('kode_ki', 10);
            $table->string('teks_ki', 191);
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
        Schema::dropIfExists('kis');
    }
}
