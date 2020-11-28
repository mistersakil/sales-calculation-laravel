<?php

namespace App\Model;


/**
 * App\Model\MyModel
 * @method string get_short_text(string $string, integer $length)
 **/

class Category extends MyModel
{
	protected static $route = 'category';

    ## Relationship ##

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function sub_categories(){
    	return $this->hasMany(Category::class,'parent_id');
    }

    public function parent_category(){
    	return $this->belongsTo(Category::class,'parent_id');
    }



}
