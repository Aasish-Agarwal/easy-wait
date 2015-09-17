<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('vendor', function(Blueprint $table)
		{
            $table->string('cell');
            $table->string('otp');
            $table->string('token');
            $table->timestamps();
            $table->primary('cell');
			$table->unique('token');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vendor');
	}
}
