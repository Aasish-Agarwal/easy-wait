<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vendor;

class VendorController extends Controller
{
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
     * Register a cell number and respond with a token to be used as its identifier.
     *
     * @return Response
     */
    public function signup($cell)
    {
        //
    	$ndigits = 3;
    	$password = str_pad(rand(1, 999), $ndigits, "0", STR_PAD_LEFT);
    	$Publickey = '0004-73762a1f-5263457d-fe7d-176d42e7';
    	$ch = curl_init();
    	// set URL and other appropriate options
    	curl_setopt($ch, CURLOPT_URL, "http://api.mOTP.in/v1/$Publickey/$cell/$password");
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	// grab URL and pass it to the browser
    	$str = curl_exec($ch);
    	// close cURL resource, and free up system resources
    	curl_close($ch);

    	$otp = $password;
    	$vendor = new Vendor();
    	$vendor->signup($cell, $otp);

    	return 'Use the last ' . $ndigits . ' digits of the number you recieved missed call from' ;
    }

    /**
     * Register a cell number and respond with a token to be used as its identifier.
     *
     * @return Response
     */
    public function verifyotp($cell,$otp)
    {
    	$vendor = new Vendor();
    	$token = $vendor -> matchOTP($cell,$otp);
    	return($token);
    }


    /**
     * Register a cell number and respond with a token to be used as its identifier.
     *
     * @return Response
     */
    public function setName($token, $name)
    {
    	$vendor = new Vendor();
    	return $vendor -> setName($token, $name);
    }



    /**
     * Register a cell number and respond with a token to be used as its identifier.
     *
     * @return Response
     */
    public function getPublicInfo($cell)
    {
    	$vendor = new Vendor();
    	return $vendor -> getPublicInfo($cell);
    }


    /**
     * Update the counter associated with a token
     * Return -1 if the counter is <0 and >999
     *
     * @return Response
     */
    public function updateCounter($token,$counter){
    	$retval = [];
    	$retval['code'] = -1;
    	if ($counter < 0 ||  $counter >999 ) {
    		return($retval);
    	}

    	$vendor = new Vendor();
    	$retval = $vendor -> updateCounter($token,$counter);

    	return ($retval);
    }

    public function setNextCounter($token){
    	$vendor = new Vendor();
    	$retval = $vendor -> setNextCounter($token);
    	return ($retval);
    }

    public function resetCounter($token){
    	$vendor = new Vendor();
    	$retval = $vendor -> resetCounter($token);
    	return ($retval);
    }

    public function getCounter($cell){
    	$vendor = new Vendor();
    	$retval = $vendor -> getCounter($cell);
    	return ($retval);
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
