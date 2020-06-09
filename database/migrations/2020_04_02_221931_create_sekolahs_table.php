<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('npsn',25);
            $table->string('kode_sekolah',25);
            $table->string('nama_sekolah',65);
            $table->string('alamat',65);
            $table->string('desa',65);
            $table->string('kec',65);
            $table->string('kab',65);
            $table->string('prov',65);
            $table->string('kode_pos',65);
            $table->string('telp',65)->nullable();
            $table->string('email',65);
            $table->string('website',65);
            $table->string('bujur',65)->nullable();
            $table->string('lintang',65)->nullable();
            $table->string('gps',10);
            $table->string('kepsek_id',30);
            $table->string('fullday',30);
            $table->string('jml_jam',3);
            $table->string('jenjang',10);
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
        Schema::dropIfExists('sekolahs');
    }
}
