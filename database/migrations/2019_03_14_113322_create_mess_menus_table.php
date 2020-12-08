<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mess_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hostel_id');
            $table->integer('breakfast_menu_id');
            $table->integer('lunch_menu_id');
            $table->integer('dinner_menu_id');
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
        Schema::dropIfExists('mess_menus');
    }
}
