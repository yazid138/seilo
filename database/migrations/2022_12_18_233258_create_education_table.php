<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->enum('tingkat_pendidikan', ['SMK', 'D3', 'D4', 'S1']);
            $table->string('institusi');
            $table->string('jurusan');
            $table->integer('nilai_akhir');
            $table->date('tanggal_masuk');
            $table->date('tanggal_lulus');
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
        Schema::dropIfExists('education');
    }
};
