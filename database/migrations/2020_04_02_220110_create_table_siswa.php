<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('sekolah_id', 15);
            $table->string('ortu_id', 15)->nullable();
            $table->string('nis', 15);
            $table->string('nisn', 20);
            $table->string('nama_siswa', 60);
            $table->string('jk', 12);
            $table->string('tempat_lahir', 60);
            $table->string('tanggal_lahir', 12);
            $table->string('alamat', 60);
            $table->string('desa', 60);
            $table->string('kec', 60);
            $table->string('kab', 60);
            $table->string('prov', 60);
            $table->string('kode_pos', 6);
            $table->string('hp', 16)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('password', 191);
            $table->string('level', 5)->default('siswa');
            $table->string('role', 5)->default('siswa');
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
        Schema::dropIfExists('siswas');
    }
}
