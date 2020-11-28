<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class BrandModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 1; $i <= 25; $i++){
    		$object                  = new \App\Model\Brand();
    		$object->name 		     = $faker->word;
    		$object->body       	 = $faker->sentence;
    		$object->published       = 1;
    		$object->slug            = Str::slug($object->name);
    		$object->image           = null;
    		$object->created_at      = date('Y-m-d h:m:s');
    		$object->updated_at      = date('Y-m-d h:m:s');
    		$object->save();
    	}
    }
}
