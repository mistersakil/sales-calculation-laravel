<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Employe;
use App\Model\Product;
use App\Model\Client;
use App\Model\Country;

use Image, Str;


class BackendController extends Controller
{
	public $default_models;

	/* Image upload process for all derived class */
	protected function image_upload($tmp_image, $image_name = 'no-name', $resize = [], $fit = [], $quality = 90){
        $image_make = Image::make($tmp_image);
        is_array($fit) ? ( count($fit) == 2 ?  $image_make->fit($fit[0],$fit[1]) : false ) : false ;
        is_array($resize) ? ( count($resize) == 2 ?  $image_make->resize($resize[0],$resize[1]) : false ) : false ;
        $image_upload_path = public_path().'/files/';
        $image_upload_path = $this->directory_exist($image_upload_path);
        $image_name = Str::slug($image_name).'.png';
        return $image_make->save($image_upload_path.$image_name,$quality) ? $image_name : false;

	}

	/* Directory exist checking if not create new */

	private function directory_exist($dir){
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);	
			return $dir;
		}
		return $dir;
	}

	/* Custom array filter */

	function custom_array_filter(array $var){
		$array_filtered = array_filter($var, function($value){
            return !empty($value);
        });
        return $array_filtered;
	}

	/* default data */

	public function default_data(){

		$this->default_models['clients'] 			= Client::orderBy('name','asc')->get();
		$this->default_models['products'] 			= Product::orderBy('name','asc')->where('status',1)->get();
		$this->default_models['employees'] 			= Employe::orderBy('name','asc')->get();
		$this->default_models['countries'] 			= Country::orderBy('name','asc')->get();

		return $this->default_models;
	}


	
}
