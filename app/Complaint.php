<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    //
    protected $table = 'complaints';


    public function csubject() {
    	return $this->belongsTo('App\ComplaintSubject','subject','id');
    }
    public function user() {
    	return $this->belongsTo('App\User','user_id','id');
    }

}
