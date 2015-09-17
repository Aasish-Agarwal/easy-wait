<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QLines extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qlines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','cell','counter','start_time', 'update_time'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    #protected $hidden = ['password', 'remember_token'];

    // Eloquent relationship that says one user belongs to each time entry
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    
}
