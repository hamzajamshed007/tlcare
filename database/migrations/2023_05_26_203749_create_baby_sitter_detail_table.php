<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBabySitterDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baby_sitter_detail', function (Blueprint $table) {
            $table->id();
            $table->string('baby_sitter_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('age');
            $table->string('lat');
            $table->string('long');
            $table->string('hourly_rate');
            $table->string('experience');
            $table->string('description');
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
        Schema::dropIfExists('baby_sitter_detail');
    }
}
