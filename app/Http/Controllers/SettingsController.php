<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function configure($token)
    {
		$filters = Input::only('skip', 'skipevery');
		$InitialEmptyPositions = $filters['skip']; 
		$PeriodicEmptyPositions = $filters['skipevery']; 
		
		$filters['token'] = $token;
		return $filters;
    }
}
