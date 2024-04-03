<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarKompetisiTable extends Migration
{
    public function up()
    {
        Schema::create('daftar_kompetisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kompetisi');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daftar_kompetisi');
    }
}