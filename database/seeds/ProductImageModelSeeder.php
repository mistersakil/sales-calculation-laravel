<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProductImageModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 1; $i <= 10; $i++){
    		$product = new \App\Model\ProductImage();
    		$product->product_id = mt_rand(1,10);
    		$product->image = $i.'.png';
    		$product->created_at = date('Y-m-d h:m:s');
    		$product->updated_at = date('Y-m-d h:m:s');
    		$product->save();
    	}
    }
}
