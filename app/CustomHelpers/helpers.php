<?php

use Illuminate\Support\Str;

## Crate sentence case of a given string ##
function _sentence_case(string $str, $type = 'strtolower'){
	$str = explode('-', $str);
	$str = implode(' ', $str);
	$str = explode('_', $str);
	$str = implode(' ', $str);
	$str = explode(' ', $str);
	$str = array_filter($str,function($value){
		return !empty($value);
	});
	$str = implode(' ', $str);			
	return $type(strtolower($str));
}

## Use this function to get short text from long text, will inherit by all derived model ##
function _custom_short_text($string, $length = 30, $doted = true){	
    if(strlen($string) <= $length) return ucfirst($string);
    $string = substr($string, 0, $length);
	$string = ucfirst(substr($string, 0 , strrpos($string, ' ')));
	if($doted){
		return $string.' ...';
	}else{
		return $string;
	}
}
## Get date only as requested format ##
function _custom_date_time($date, $format = 'Y-m-d'){    	
    return date_format(date_create($date),$format);
}

