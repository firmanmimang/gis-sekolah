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
            $table->foreignId('id_jenjang');
            $table->foreignId('id_kecamatan');
            $table->string('sekolah', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->string('status', 15);
            $table->string('alamat', 255);
            $table->string('posisi', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();
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
