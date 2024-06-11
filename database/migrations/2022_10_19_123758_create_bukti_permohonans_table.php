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
        Schema::create('bukti_permohonans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemohon_id');
            $table->string('dokumen_standar_teknis');
            $table->string('bukti_kepemilikan');
            $table->string('bukti_kesesuaian_tata_letak');
            $table->string('foto_kondisi_lokasi');
            $table->timestamps();

            $table->foreign('pemohon_id')->references('id')->on('pemohons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukti_permohonans');
    }
};
