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
        Schema::create('status_permohonans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemohon_id');
            $table->string('status');
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
        Schema::dropIfExists('status_permohonans');
    }
};
