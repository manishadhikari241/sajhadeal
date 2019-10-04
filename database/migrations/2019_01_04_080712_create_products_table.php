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
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->double('price');
            $table->double('sale_price')->nullable();
            $table->date('special_from')->nullable();
            $table->date('special_to')->nullable();
            $table->date('new_from')->nullable();
            $table->date('new_to')->nullable();
            $table->boolean('featured')->default(0);
            $table->integer('views')->nullable()->default(0);
            $table->integer('brand_id')->unsigned()->default(0);
            $table->boolean('size_variation')->default(0);
            $table->integer('stock_quantity')->nullable();
            $table->string('sku');
            $table->string('video')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->ondelete('cascade');
            $table->string('short_description');
            $table->longText('long_description')->nullable();
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
