<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosems', function (Blueprint $table) {
            $table->id();
            $table->string('semester', 12);
            $table->string('periode', 12);
            $table->string('mapel_id', 12);
            $table->string('tingkat', 12);
            $table->string('kd_id', 12);
            $table->string('ket', 100);
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
        Schema::dropIfExists('prosems');
    }
}
