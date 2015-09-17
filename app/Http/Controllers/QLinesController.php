<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Request;
use App\QLines;

class QLinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$lines = QLines::with('user')->get();
		
		$lines1 = array(
		    'name'  => 'aashish',
		    'age' => 24
		);
		
		// [{"id":1,"user_id":1,"cell":"9910006970","counter":3,"start_time":"2010-11-12 00:00:00","update_time":"2010-11-12 00:00:00","user":{"id":1,"name":"Aashish Agarwal","email":"ashu_agn@yahoo.com","created_at":"2015-08-28 17:34:01","updated_at":"2015-08-29 10:30:20"}}]
		#return $lines;
		return view('qlines.index', compact('lines'));
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
    	$data = Request::all();
    	
    	$line = new QLines();
    	
    	$line->fill($data);
    	
    	$line->save();
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
		$line = QLines::find($id);
		
		$data = Request::all();
		
		$line->fill($data);
		
		$line->save();
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
		$line = QLines::find($id);
    			
		$line->delete();
    }
}
