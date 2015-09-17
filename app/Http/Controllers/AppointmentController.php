<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vendor;
use App\Appointments;

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
		$retval['status'] = 0;
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
			$retval['status'] = 1;
			$retval['counter'] = $apointment->isbBoked($cell, $reference);
			return 	$retval;
		} else {
			$booking_successful = 0;
			while ( ! $booking_successful ) {
				$next_counter = $vendor->getNextAvailableCounter($cell);
				
				if ($counter>$next_counter ) 
				{
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
					$vendor->setNextAvailableCounter($cell);
					$next_counter = $vendor->getNextAvailableCounter($cell);
					if ( $apointment->book($cell, $reference, $next_counter-1) > 0  )
					{
						$booking_successful = 1;
						$retval['counter'] = $next_counter-1;
						$retval['status'] = 1;
						$retval['srvr_msg'] = 'Booking Successful';
					}
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
		$vendor->resetNextAvailableCounter($cell);
		
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
