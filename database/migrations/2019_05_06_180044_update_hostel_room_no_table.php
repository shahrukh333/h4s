<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHostelRoomNoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hostel_rooms', function (Blueprint $table) {
            $table->integer('room_no')->nullable()->after('hostel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hostel_rooms', function (Blueprint $table) {
            $table->dropColumn('room_no');
        });
    }
}
