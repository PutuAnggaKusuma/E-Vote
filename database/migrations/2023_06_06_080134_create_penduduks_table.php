<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('KTP')->nullable();
            $table->string('KK');
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->enum('agama', ['Buddha', 'Hindu', 'Islam', 'Katolik', 'Konghucu', 'Kristen']);
            $table->string('no_telp');
            $table->foreignId('id_banjars')->constrained('banjars')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('penduduks');
    }
}
