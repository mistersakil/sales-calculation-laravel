<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class CategoryModelSeeder extends Seeder
{
  
    public function run(Faker $faker)
    {
    	for($i = 1; $i <= 5; $i++){
    		$object                  = new \App\Model\Category();
    		$object->parent_id       = 0;
    		$object->name 		     = $faker->word;
    		$object->body       	 = $faker->sentence;
    		$object->published       = 1;
    		$object->slug            = Str::slug($object->name);
    		$object->image           = 0;
    		$object->created_at      = date('Y-m-d h:m:s');
    		$object->updated_at      = date('Y-m-d h:m:s');
    		$object->save();
    	}
        
    }
}
