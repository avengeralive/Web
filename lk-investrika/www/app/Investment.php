<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    function user() {
        return $this->belongsTo('App\User');
    }

    public function docs() {
		return $this->belongsToMany('App\Doc','doc_investment');
	}
	
	function product() {
        return $this->belongsTo('App\Product');
    }
}
