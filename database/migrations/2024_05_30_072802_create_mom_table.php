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
        Schema::create('mom', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('project')->nullable();
            $table->string('location')->nullable();
            $table->time('time_awal')->nullable();
            $table->time('time_akhir')->nullable();
            $table->text('attendance')->nullable();
            $table->text('plan')->nullable();
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
        Schema::dropIfExists('table_mom');
    }
};
