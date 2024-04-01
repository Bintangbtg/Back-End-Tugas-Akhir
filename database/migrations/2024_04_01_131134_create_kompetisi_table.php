<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kompetisi');
            $table->text('deskripsi');
            $table->enum('kategori', ['Desain', 'Programming', 'Robotic', 'CTF']);
            $table->decimal('biaya_pendaftaran', 10, 2);
            $table->string('foto_poster')->nullable(); // Jika ingin memungkinkan null, tambahkan nullable()
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
        Schema::dropIfExists('kompetisi');
    }
}