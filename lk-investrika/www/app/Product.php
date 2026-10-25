<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	
	public function logo() {
		return $this->belongsTo('App\Image','image_id');
	}
	
	public function images() {
		return $this->belongsToMany('App\Image','image_product');
	}
	
	public function categories() {
		return $this->belongsToMany('App\Category','category_product');
	}
	
	public function attributes() {
        return $this->belongsToMany('App\Attribute', 'attribute_product')->withPivot('id','value');
    }
	
	public function investments() {
		return $this->hasMany('App\Investment');
	}
	
	public function bids() {
		return $this->hasMany('App\Bid');
	}
	
	public function currentSumm()
	{
		$summ = 0;
		foreach ($this->investments as $investment) {
			$summ += $investment->summ;
		}
		return round($summ, 2);
	}
}
