<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';

    protected $fillable = ['file','featured','mediable_id','mediable_type'];


    public function get_year(){
        return date_format(date_create($this->created_at),'Y');
    }
    public function get_month_full_name(){
    	return date_format(date_create($this->created_at),'F');
    }

    ## Relationship

    public function mediable(){
    	return $this->morfTo();
    }


}
