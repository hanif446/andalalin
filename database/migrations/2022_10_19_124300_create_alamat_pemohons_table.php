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
        Schema::create('alamat_pemohons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemohon_id');
            $table->text('alamat_pemohon');
            $table->string('kecamatan_pemohon');
            $table->string('kota_pemohon');
            $table->unsignedBigInteger('provinsi_id');
            $table->string('kode_pos_pemohon');
            $table->timestamps();

            $table->foreign('pemohon_id')->references('id')->on('pemohons')->onDelete('cascade');
            $table->foreign('provinsi_id')->references('id')->on('provinsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat_pemohons');
    }
};
