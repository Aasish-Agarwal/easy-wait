<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppointmentsFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::table('vendor', function($table)
			{
			    $table->integer('accepting_appointments')->unsigned()->default(0);
			    $table->integer('next_available_counter')->unsigned()->default(1);
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor', function($table)
		{
		    $table->dropColumn('accepting_appointments');
		    $table->dropColumn('next_available_counter');
		});
    }
}
