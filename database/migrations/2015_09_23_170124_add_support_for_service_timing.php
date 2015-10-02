<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupportForServiceTiming extends Migration
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
			    $table->integer('starttm')->default(0);
			    $table->integer('updtm')->default(0);
			    $table->integer('service_type')->default(1);
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
		    $table->dropColumn('starttm');
		    $table->dropColumn('updtm');
			$table->dropColumn('service_type');
		});
    }
}
