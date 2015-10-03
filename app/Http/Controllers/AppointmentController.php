<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vendor;
use App\Appointments;
use App\Settings;

class AppointmentController extends Controller
{
	/**
	 * Cancel & Existing Booking
	 *
	 * @return Response
	 */
	public function cancel($cell, $reference)
	{
		$retval = array();
		$retval['status'] = 1;
		$apointment = new Appointments();
		$apointment->cancel($cell, $reference);
		return($retval);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function book($cell, $reference,$counter=0)
	{
		$retval = array();
		$retval['status'] = -1;
		$retval['srvr_msg'] = 'Bookings Closed';

		$vendor = new Vendor();
		$apointment = new Appointments();
		
		$reference = strtoupper(trim($reference));
		
		## Return if invalid vendor
		if ( ! $vendor->isValidVendor($cell) ) 
		{
			$retval['srvr_msg'] = 'Invalid Vendor';
			return 	$retval;
		} else if ( ! $vendor->isAcceptingAppointments($cell) ) {
			
			$retval['srvr_msg'] = 'Bookings Closed';
			return 	$retval;
		}
		else if ( $apointment->isbBoked($cell, $reference) > 0  ) {
			$retval['srvr_msg'] = 'Already Booked';
			$retval['status'] = -1;
			return 	$retval;
		} else {
			$booking_successful = 0;
			$initial_empty_positions = Settings::get($cell, Settings::INITIAL_EMPTY_POSITIONS);
			$periodic_empty_position = Settings::get($cell, Settings::PERIODIC_EMPTY_POSITION);
				
			$next_counter = $vendor->getNextAvailableCounter($cell);
				
			if ($next_counter <= $initial_empty_positions) {
					$this->reset($cell);
					$vendor->resetNextAvailableCounter($cell, $initial_empty_positions + 1);
					$next_counter = $initial_empty_positions + 1;
			}

			while ( ! $booking_successful ) {
				if ($counter > $next_counter ) 
				{
					if ( $periodic_empty_position > 0  
						&& ($counter % $periodic_empty_position) == 0 ) {
						$apointment->book($cell, '* FREE *-- ' .  $counter , $counter);
						$counter++;
					}
					
					if ( $apointment->book($cell, $reference, $counter) > 0  )
					{
						$booking_successful = 1;
						$retval['counter'] = $counter;
						$retval['status'] = 1;
						$retval['srvr_msg'] = 'Booking Successful';
					} else 
					{
						$counter++;
					}
				} else 
				{
					if ( $periodic_empty_position > 0  
						&& ($next_counter % $periodic_empty_position) == 0 ) {
						$vendor->setNextAvailableCounter($cell);
						$apointment->book($cell, 'FREE: ' .  $next_counter , $next_counter);
						$next_counter = $vendor->getNextAvailableCounter($cell);
					}
					if ( $apointment->book($cell, $reference, $next_counter) > 0  )
					{
						$booking_successful = 1;
						$retval['counter'] = $next_counter;
						$retval['status'] = 1;
						$retval['srvr_msg'] = 'Booking Successful';
					}
					$vendor->setNextAvailableCounter($cell);
					$next_counter = $vendor->getNextAvailableCounter($cell);
				}
			}			
		}
		return $retval;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function isAccepting($cell)
	{
		$retval = array();
		$retval['status'] = 1;
		$vendor = new Vendor();
		$retval['bookings_open'] = $vendor->isAcceptingAppointments($cell);
		return $retval;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function retrieve($token, $counter)
	{
		$retval = array();
		$retval['code'] = 1;
		$retval['counter'] = 10;
		$retval['reference'] = 'New Patient';
		return $retval;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function reset($token)
	{
		$retval = array();
		$retval['code'] = 1;
		
		# Get the cell number
		$vendor = new Vendor();
		$cell = $vendor->getCellNumber($token);
		$vendor->resetNextAvailableCounter($cell,Settings::get($cell, Settings::INITIAL_EMPTY_POSITIONS) + 1);
		
		# Remove all appointments against the cell
		$apointment = new Appointments();
		$apointment->reset($cell);
		return $retval;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function accept($token)
	{
    	$vendor = new Vendor();
		return $vendor->AcceptAppointments($token,true);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function close($token)
	{
    	$vendor = new Vendor();
		return $vendor->AcceptAppointments($token,false);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function retrieveAll($token,$counter)
	{
		# Get the cell number
		$vendor = new Vendor();
		$cell = $vendor->getCellNumber($token);

		$apointment = new Appointments();
		return $apointment->retrieveAll($cell,$counter);;
	}
	
	
	
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
