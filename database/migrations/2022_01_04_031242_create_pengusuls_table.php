<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengusulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengusuls', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('id_user');
            $table->string('nama_pengusul');
            $table->bigInteger('no_identitas');
            $table->string('status_pengusul');
            $table->string('no_hp');
            $table->string('email');
            $table->string('keterangan');
            $table->string('surat_penawaran');
            $table->string('status_validator')->default('Diproses');
            $table->string('status_pbj')->default('Diproses');
            $table->string('status_app_validator')->default('diproses');
            $table->string('jenis_usulan')->default('LELANG');
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
        Schema::dropIfExists('pengusuls');
    }
}
