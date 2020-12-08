<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hostel_id');
            $table->string('wifi');
            $table->string('mess');
            $table->string('tv');
            $table->string('cctv_camera');
            $table->string('laundry');
            $table->string('power_backup');
            $table->string('daily_clean');
            $table->string('iron');
            $table->string('geyser');
            $table->string('refrigerator');
            $table->string('other_1')->nullable();
            $table->string('other_2')->nullable();
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
        Schema::dropIfExists('hostel_facilities');
    }
}
