<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('admin_id');
            $table->string('name',200);
            $table->string('slug',200);
            $table->longText('body');
            $table->unsignedInteger('quantity')->default(0);
            $table->boolean('stock')->default(true)->comment('Is this product available in stock? 1 = yes, 0 = no');
            $table->boolean('published')->default(true)->comment('Is this product published? 1 = yes, 0 = no');
            $table->unsignedDecimal('price',8,2);
            $table->unsignedDecimal('sale_price',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
