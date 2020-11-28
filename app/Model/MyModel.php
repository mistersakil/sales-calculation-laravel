<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{

    ## Use this function to get short text from long text, will inherit by all derived model ##
    public function custom_short_text($string, $length = 30){
    	
        if(strlen($string) <= $length) return ucfirst($string);
        $string = substr($string, 0, $length);
    	return ucfirst(substr($string, 0 , strrpos($string, ' '))).' ...';
    }

    ## Get date only as requested format ##
    public function custom_date_time($date, $format = 'Y-m-d'){    	
         return date_format(date_create($date),$format);
    }

    ## Set status ##
    public function custom_status(){     
         return [
            '1' => 'Active',
            '0' => 'Inactive',
        ];
    }


    ## Set progress status  ##
    public function custom_progress(){     
         return [
            '0' => 'Initiate',
            '1' => 'Ongoing',
            '2' => 'Testing',
            '3' => 'Live',
        ];
    }
}
