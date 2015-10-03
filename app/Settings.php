<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];
    public $timestamps = false;
    
    const INITIAL_EMPTY_POSITIONS = 'skip';
    const PERIODIC_EMPTY_POSITION = 'skip_every';
	const NUM_SETTINGS = 2;    
    public function set($cell,$name,$value)
    {
    	$settings = Settings::firstOrNew(array('cell' => $cell, 'name' => $name));
    	$settings->value = $value;
    	$settings->cell = $cell;
    	$settings->name = $name;
    	$settings->save();
    }

    public static function get($cell,$name)
    {
        $retval = 'undefined';
    	try {
	    	$results = Settings::where(array('cell' => $cell, 'name' => $name))
	    	->firstOrFail();
	    	$retval = $results->value;
    	} catch ( \Exception $e) {
    		
    	}
		return $retval;
    }
    
}
