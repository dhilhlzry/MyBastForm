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
        Schema::create('bast_form', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('projectid');
            $table->bigInteger('sprint')->nullable();
            $table->string('bast_no')->nullable();
            $table->date('bast_date');
            $table->integer('revision');
            $table->string('nama_pihak1',100);
            $table->string('perusahaan_pihak1');
            $table->text('alamat_pihak1');
            $table->string('jabatan_pihak1',50);
            $table->string('nama_pihak2',100);
            $table->string('perusahaan_pihak2');
            $table->text('alamat_pihak2');
            $table->string('jabatan_pihak2',50);
            $table->string('phase',100);
            $table->string('of_number',50);
            $table->string('signature1')->nullable();
            $table->string('date_signature1')->nullable();
            $table->string('signature2')->nullable();
            $table->string('date_signature2')->nullable();
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
        Schema::dropIfExists('bast_form');
    }
};
