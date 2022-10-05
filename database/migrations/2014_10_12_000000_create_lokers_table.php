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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();

            $table->string('judul')->nullable();
            $table->string('employe')->nullable();
            $table->text('alamat')->nullable();
            $table->string('tanggal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('gaji')->nullable();
            $table->enum('role', ['magang', 'onsite', 'remote'])->nullable();
            $table->enum('active', ['active', 'nonactive'])->default('active');
            $table->string('penulis')->nullable();
            $table->string('pengalaman')->nullable();
            $table->string('skill')->nullable();

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
        Schema::dropIfExists('lokers');
    }
};
