<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
    protected $table = 'bids';

    public function product()
    {
    	return $this->belongsTo('App\Product','product_id','id');
    }
    public function bidder()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public static function maxBid($product_id)
    {
        return Bid::where('product_id',$product_id)
                    ->orderBy('price','desc')
                    ->first();
    }

}
