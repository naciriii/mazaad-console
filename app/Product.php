<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";

     public function details()
    {
    	return $this->hasOne('App\ProductDetail','product_id','id');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category','category_id','id');
    }
    public function mainPicture()
    {
        return $this->belongsToMany('App\Picture','product_pictures','product_id','picture_id')
        ->wherePivot('is_main',true);

    }
    public function pictures()
    {
    	return $this->belongsToMany('App\Picture','product_pictures','product_id','picture_id')
        ->wherePivot('is_main',false);
    }
    public function region()
    {
    	return $this->belongsTo('App\Region','region_id','id');
    }
    public function owner()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
       public function bids()
    {
        return $this->hasMany('App\Bid','product_id','id');
    }
    public function topBid()
    { 
        if ($this->bids->count()) {
        return $this->bids()->orderBy('price','desc')->first()->price;
     }
     return $this->start_price;
    }
    public function winningBid()
    {
        return $this->hasOne('App\Bid','product_id','id')
                      ->where('is_winning',true);
    }
}
