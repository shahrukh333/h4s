<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostelInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hostel_name');
            $table->string('phone_number');
            $table->string('hostel_category');
            $table->string('hostel_country');
            $table->string('hostel_province');
            $table->string('hostel_city');
            $table->string('hostel_street');
            $table->string('hostel_address_line')->nullable();
            $table->double('hostel_rent');
            $table->string('rent_period');
            $table->string('hostel_description');
            $table->string('landmarks');
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
        Schema::dropIfExists('hostel_informations');
    }
}
