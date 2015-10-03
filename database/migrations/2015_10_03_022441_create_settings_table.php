<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('settings', function(Blueprint $table)
		{
            $table->increments('id');
			$table->string('cell');
            $table->string('name',64);
            $table->string('value',64);
			$table->unique(array('cell', 'name'));
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('settings');
    }
}
