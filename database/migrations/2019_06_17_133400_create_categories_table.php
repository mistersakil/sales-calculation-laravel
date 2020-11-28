<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('parent_id')->nullable()->default(0);
            $table->string('name',100)->unique();
            $table->text('body')->nullable();
            $table->string('slug');
            $table->string('image')->nullable()->default(0);
            $table->boolean('published')->default(1)->comment('Is this category published? 1 = yes, 0 = no');
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
        Schema::dropIfExists('categories');
    }
}
