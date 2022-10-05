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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->text('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->unsignedBigInteger('id_jabatan')->nullable();
            $table->string('jk')->nullable();
            $table->string('foto_user')->nullable();
            $table->text('cv')->nullable();
            $table->enum('verifikasi', ['1','2'])->default('1');
            $table->unsignedBigInteger('id_loker')->nullable();

            $table->rememberToken();
            $table->timestamps();

            //relasi table jabatan
            $table->foreign('id_jabatan')->references('id')->on('jabatans');
            //relasi table loker
            $table->foreign('id_loker')->references('id')->on('lokers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
