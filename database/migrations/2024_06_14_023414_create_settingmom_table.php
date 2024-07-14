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
        Schema::create('settingdoc', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('margin_y');
            $table->string('margin_x');
            $table->string('col1_mt');
            $table->string('col2_mt');
            $table->string('col3_mt');
            $table->string('col4_mt');
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
        Schema::dropIfExists('settingmom');
    }
};
