<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cell'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    #protected $hidden = ['otp', 'token'];

    /**
     * Returns the state of the vendor, if the bookings are opne or close.
     *
     * @var array
     */
    public function isAcceptingAppointments($cell) 
    {
    	$bkng_open = 0;

    	$vndr = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->get();
    	if ( count($vndr) > 0 ) {
    		$bkng_open = $vndr[0]->accepting_appointments;
    	}
    	return $bkng_open;
    }

    /**
     * Returns the state of the vendor, if the bookings are opne or close.
     *
     * @var array
     */
    public function AcceptAppointments($token,$bkng_open)
    {
    	$retval = [];
    	$retval['code'] = 0;
    	try {
	    	\DB::table($this->table)
	    	->where('token', $token)
	    	->update(['accepting_appointments' => $bkng_open]);
    	} catch ( \Exception $e) {
    		$retval['code'] = $e->errorInfo[0];
    	}
    	return($retval);
    }
    
    /**
     * The function matches the OTP against an existing cell number.
     * Returns token if matched
     * -2 if cell not matched
     * -1 if OTP not matched
     *
     * @var array
     */
    public function matchOTP($cell,$otp)
    {
    	$retval = [];
    	$retval['token'] = 'undef';
    	$vndr = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->get();
    	if ( count($vndr) > 0 ) {
				$first = $vndr[0];
				if ( $vndr[0]->otp == $otp ) {
					$retval['token'] = $vndr[0]->token;
				} else {
					$retval['token'] = 'undef';
				}
    	}
    	return $retval;
    }
    
    /**
     * The function updates the counter against an existing token number.
     * 0 if no errors
     * dbms error code on failure
     *
     * @var array
     */
    public function updateCounter($token,$counter) 
    {
    	$retval = [];
    	$retval['code'] = 0;
    	$tmnow = time();
    	 
    	try {
    		if ( $counter == 0 ) {
		    	\DB::table($this->table)
		    	->where('token', $token)
		    	->update(['counter' => $counter, 'updtm' => $tmnow , 'starttm' => 0]);
    		} else {
    			\DB::table($this->table)
    			->where('token', $token)
    			->update(['counter' => $counter, 'updtm' => $tmnow]);

    			\DB::update('update vendor set starttm = updtm where token = ? and starttm = 0', array($token));
    		}
    	} catch ( \Exception $e) {
    		$retval['code'] = $e->errorInfo[0];
    	}
    	return($retval);
    }
    
    
    /**
     * The function updates the counter by 1.
     * 0 if no errors
     * dbms error code on failure
     *
     * @var array
     */
    public function setNextCounter($token) 
    {
    	$vndr = \DB::table($this->table)
    	->where('token', '=', $token)
    	->get();

    	return $this->updateCounter($token,$vndr[0]->counter+1);
    }

    
    public function isValidVendor($cell)
    {
    	$valid_vendor = 0;
    	$vndr = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->get();
    	if ( count($vndr) > 0 ) {
    		$valid_vendor = 1;
    	}
    	return $valid_vendor;
    }
    
    /**
     *
     * @var array
     */
    public function getNextAvailableCounter($cell)
    {
    	$next_available_counter = -1 ;

    	$vndr = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->get();
    	if ( count($vndr) > 0 ) {
				$next_available_counter = $vndr[0]->next_available_counter;
    	}
    	return $next_available_counter;
    }
    
    /**
     *
     * @var array
     */
    public function setNextAvailableCounter($cell)
    {
    	$retval = [];
    	$retval['code'] = 0;
    	try {
    		\DB::update('update vendor set next_available_counter = next_available_counter + 1 where cell = ?', array($cell));
    	} catch ( \Exception $e) {
    		$retval['code'] = $e->errorInfo[0];
    	}
    	return($retval);
    }

    /**
     *
     * @var array
     */
    public function resetNextAvailableCounter($cell,$counter)
    {
    	$retval = [];
    	$retval['code'] = 0;
    	try {
    		\DB::update('update vendor set next_available_counter = ? where cell = ?', array($counter,$cell));
    	} catch ( \Exception $e) {
    		$retval['code'] = $e->errorInfo[0];
    	}
    	return($retval);
    }
    
    /**
     * The function sets the counter to 0.
     * 0 if no errors
     * dbms error code on failure
     *
     * @var array
     */
    public function resetCounter($token)
    {
    	return $this->updateCounter($token,0);
    }
    
    /**
     * The function supplies the counter value stored against the cell number.
     * -1 if cell not matched
     *
     * @var array
     */
    public function getCounter($cell)
    {
    	$retval = [];
    	$retval['counter'] = '-1';
    	$vndr = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->get();
    	if ( count($vndr) > 0 ) {
				$first = $vndr[0];
				$retval['counter'] = $vndr[0]->counter;
				$retval['bookings_open'] = $vndr[0]->accepting_appointments;
    			$retval['qsize'] = $vndr[0]->next_available_counter;
				$retval['starttm'] = $vndr[0]->starttm;
    			$retval['updtm'] = $vndr[0]->updtm;
    			$retval['tmnow'] = time();
    	}
    	return $retval;
    }
    
    /**
     * The function supplies the counter value stored against the cell number.
     * -1 if cell not matched
     *
     * @var array
     */
    public function getPublicInfo($cell)
    {
    	$retval = [];
    	$retval['found'] = -1;
    	$vndr = \DB::table($this->table)
    	->where('cell', '=', $cell)
    	->get();
    	if ( count($vndr) > 0 ) {
    		$first = $vndr[0];
    		$retval['name'] = $vndr[0]->name;
    		$retval['cell'] = $vndr[0]->cell;
    		$retval['found'] = 0;
    	}
    	return $retval;
    }
    
    /**
     * The function identifies the cell number against the authentication token
     * 0 if token not matches
     *
     * @var array
     */
    public function getCellNumber($token)
    {
    	$cell = 0;
    	$vndr = \DB::table($this->table)
    	->where('token', '=', $token)
    	->get();
    	if ( count($vndr) > 0 ) {
    		$cell = $vndr[0]->cell;
    	}
    	return $cell;
    }
    
    /**
     * The function stores a new OTP against an existing cell number.
     *
     * @var array
     */
    public function setNewOTP($cell,$otp)
    {
    	\DB::table($this->table)
    	->where('cell', $cell)
    	->update(['otp' => $otp]);
    }

    /**
     * The function stores the cell, otp and token for the first time registration
     * In Case the number is already existing updates OTP.
     *
     * @var array
     */
    
    public function getUniqueToken()
    {
   		$isUnique = 0;
   		while ( $isUnique < 1 ) 
   		{
   			$token = strtoupper(md5(uniqid(rand(), true)));
   			
   			$vndr = \DB::table($this->table)
   			->where('token', '=', $token)
   			->get();

   			if ( count($vndr) < 1 ) {
   				$isUnique = 1;
   			}
   		}
   		
   		return $token ;
    }

    
    /**
     * The function updates the name of the vendor against his published number
     *
     * @var array
     */
    public function setName($token, $name) 
    {
    	$retval = [];
    	$retval['code'] = 0;
    	try {
    		\DB::update('update vendor set name = ? where token = ?', array($name, $token));
    	} catch ( \Exception $e) {
    		$retval['code'] = $e->errorInfo[0];
    	}
    	return($retval);
    }    
    
    /**
     * The function stores the cell, otp and token for the first time registration
     * In Case the number is already existing updates OTP.
     *
     * @var array
     */
    public function signup($cell,$otp)
    {
    	$error_code = 0;
    	
    	$token = $this->getUniqueToken();
    	
    	try {
	    	\DB::table($this->table)->insert(
	    	['cell' => $cell, 'otp' => $otp, 'token' => $token]
	    	);
    	} catch ( \Exception $e) {
    		#var_dump($e->errorInfo );
    		$error_code = $e->errorInfo[0];
    	}

    	if ($error_code == '23000') {
    		$this->setNewOTP($cell,$otp);
    	};
    }
}
