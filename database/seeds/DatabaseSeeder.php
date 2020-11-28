<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductModelSeeder::class);
        $this->call(CategoryModelSeeder::class);
        $this->call(BrandModelSeeder::class);
    }
}
