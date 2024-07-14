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
        Schema::create('bast_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bastid');
            $table->string('fitur');
            $table->text('deskripsi');
            $table->string('penguji');
            $table->date('tanggaluji');
            $table->string('paraf')->nullable();
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
        Schema::dropIfExists('bast_detail');
    }
};
