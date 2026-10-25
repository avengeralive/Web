<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	public function images() {
		return $this->belongsToMany('App\Image','image_category');
	}
	public function parentCategory() {
		return $this->belongsTo('App\Category', 'parent_category_id');
	}
	public function products() {
		return $this->belongsToMany('App\Product', 'category_product');
	}
}
