<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostlRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostl_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hostel_id');
            $table->string('rule_1')->nullable();
            $table->string('rule_2')->nullable();
            $table->string('rule_3')->nullable();
            $table->string('rule_4')->nullable();
            $table->string('rule_5')->nullable();
            $table->string('rule_6')->nullable();
            $table->string('rule_7')->nullable();
            $table->string('rule_8')->nullable();
            $table->string('rule_9')->nullable();
            $table->string('rule_10')->nullable();
            $table->string('rule_11')->nullable();
            $table->string('rule_12')->nullable();
            $table->string('rule_13')->nullable();
            $table->string('rule_14')->nullable();
            $table->string('rule_15')->nullable();
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
        Schema::dropIfExists('hostl_rules');
    }
}
