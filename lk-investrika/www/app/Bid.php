<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
	function user() {
        return $this->belongsTo('App\User');
    }
	
	function product() {
        return $this->belongsTo('App\Product');
    }
}
