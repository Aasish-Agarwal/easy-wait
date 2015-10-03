<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function set($token)
    {
		$retval = array();
		$retval['status'] = 1;
    	
		$filters = Input::only(Settings::INITIAL_EMPTY_POSITIONS, Settings::PERIODIC_EMPTY_POSITION);
		
		$vendor = new Vendor();
		$cell = $vendor->getCellNumber($token);

		$settings = new Settings();

		if ( isset($filters[Settings::INITIAL_EMPTY_POSITIONS]) ) {
			$settings->set($cell,
							Settings::INITIAL_EMPTY_POSITIONS,
								$filters[Settings::INITIAL_EMPTY_POSITIONS]);
		}
		
		if ( isset($filters[Settings::PERIODIC_EMPTY_POSITION]) ) {
			$settings->set($cell,
							Settings::PERIODIC_EMPTY_POSITION,
								$filters[Settings::PERIODIC_EMPTY_POSITION]);
		}
		
		return $retval;
    }


    public function get($token)
    {
    	$retval = array();
    	$retval['status'] = 1;
    	 
		$options = Input::only('fields');
    	    
    	$vendor = new Vendor();
    	$cell = $vendor->getCellNumber($token);
    
    	$settings = new Settings();
    
    	if ( isset($options['fields']) ) {
    		$filters = explode ( ',', $options['fields'], Settings::NUM_SETTINGS + 1);

    		foreach ($filters as $name) {
    			$retval[$name] = $settings->get($cell,$name);
    		}
    	} 
    	return $retval;
    }
}
