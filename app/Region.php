<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = "regions";

     protected $fillable = [
        'name', 
    ];

    public function products()
    {
    	return $this->hasMany('App\Product','region_id','id');
    }
}
