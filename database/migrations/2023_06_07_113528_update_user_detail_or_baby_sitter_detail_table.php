<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserDetailOrBabySitterDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_detail', function (Blueprint $table) {
            $table->string('user_id')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('lat')->nullable()->change();
            $table->string('long')->nullable()->change();
        });

        Schema::table('baby_sitter_detail', function (Blueprint $table) {
            $table->string('baby_sitter_id')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('age')->nullable()->change();
            $table->string('hourly_rate')->nullable()->change();
            $table->string('lat')->nullable()->change();
            $table->string('long')->nullable()->change();
            $table->string('experience')->nullable()->change();
            $table->string('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_detail', function (Blueprint $table) {
            //
        });
    }
}
