<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class ProductModelSeeder extends Seeder
{
   
    public function run(Faker $faker)
    {
    	for($i = 1; $i <= 10; $i++){
    		$product                  = new \App\Model\Product();
    		$product->category_id     = mt_rand(1,10);
    		$product->brand_id        = mt_rand(1,10);
    		$product->admin_id        = mt_rand(1,10);
    		$product->name            = $faker->sentence;
    		$product->slug            = Str::slug($product->name);
    		$product->body            = $faker->text(500);
    		$product->quantity        = 10 * $i;
            $product->stock           = 1;
    		$product->published       = 1;
    		$product->price           = (1000 + $i);
    		$product->sale_price      = $product->price - 150;
    		$product->created_at      = date('Y-m-d h:m:s');
    		$product->updated_at      = date('Y-m-d h:m:s');
    		$product->save();
    	}
        
    }
}
