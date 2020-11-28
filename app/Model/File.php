<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $table = 'files';

    protected $fillable = ['file','extension'];
    
    ## Relationship ##

    public function fileable(){
    	return $this->morphTo();
    }
}
