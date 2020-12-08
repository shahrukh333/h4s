<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBookingrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookingrequests', function (Blueprint $table) {
            $table->date('check_in')->nullable()->after('user_id');
            $table->date('check_out')->nullable()->after('check_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookingrequests', function (Blueprint $table) {
            $table->dropColumn('check_in');
            $table->dropColumn('check_out');
        });
    }
}
