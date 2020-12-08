<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRomFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rom_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hostel_id');
            $table->string('ac');
            $table->string('fan');
            $table->string('wardrobe');
            $table->string('attach_washroom');
            $table->string('ventilation');
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
        Schema::dropIfExists('rom_facilities');
    }
}
