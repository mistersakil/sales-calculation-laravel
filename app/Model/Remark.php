<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Datatables;

class Remark extends MyModel
{
    protected $table = 'remarks';
    protected $fillable = ['body'];

    ## Relationship ##

    public function remarkable(){
    	return $this->morphTo();
    }
}
