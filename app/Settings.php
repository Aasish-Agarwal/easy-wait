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

    const INITIAL_EMPTY_POSITIONS = 'skip';
    const PERIODIC_EMPTY_POSITION = 'skip_every';
    
    public function set($token,$name,$value)
    {

    
    }

    public static function get($cell,$name)
    {
		if ($name == Settings::INITIAL_EMPTY_POSITIONS ) {
			return 10;
		}

		if ($name == Settings::PERIODIC_EMPTY_POSITION ) {
			return 5;
		}
		
    }
    
}
