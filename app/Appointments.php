<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    public function isbBoked($cell, $reference)
    {
    	$counter = -1;
   	 
    	$appointment = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->where('reference', '=', $reference)
    	->get();
    	if ( count($appointment) > 0 ) {
    		$counter = $appointment[0]->counter;
    	}
    	return $counter;
    }
    
    public function retrieveAll($cell,$counter)
    {
    	$appointment = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->where('counter', '>=', $counter)
    	->orderBy('counter')
    	->get();
    	return $appointment;
    }

    /**
     * The function removes entry from appointment table against the cell and reference
     *
     * @var array
     */
    public function cancel($cell, $reference)
    {
    	$status = 1;
    	$cell = trim ($cell);
    	
    	try {
    		\DB::table($this->table)
    		->where('cell', '=', $cell)
    		->where('reference', '=', $reference)
    		->delete();
    	} catch ( \Exception $e) {
    		#var_dump($e->errorInfo );
    	}
    	return $status;
    }
    /**
     * The function makes an entry in to appointment table against the cell and reference
     *
     * @var array
     */
    public function book($cell, $reference, $counter)
    {
    	$status = -1;
   	
    	$cell = trim ($cell);
    	$reference = trim($reference);
    	
    	try {
	    	# If existing booking return counter
	    	
    		# If new booking
    		# Insert new row
    		# update counter
    		
    		\DB::table($this->table)->insert(
	    	['cell' => $cell, 'reference' => $reference, 'counter' => $counter]
	    	);
    		$status = 1;
    	} catch ( \Exception $e) {
    		#var_dump($e->errorInfo );
    	}
    	return $status;
    }

    /**
     * The function removes all appointments against a cell
     *
     * @var array
     */
    public function reset($cell)
    {
    	$status = 1;
    	$cell = trim ($cell);
    	 
    	try {
    		\DB::table($this->table)->where('cell', '=', $cell)->delete();
    	} catch ( \Exception $e) {
	    	#var_dump($e->errorInfo );
	    }
	    return $status;
    }
}
