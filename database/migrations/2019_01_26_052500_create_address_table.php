<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
//            $table->string('zone');
//            $table->string('city');
            $table->string('address');
            $table->double('phone');
            $table->integer('shipping_id')->unsigned();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->ondelete('cascade');
            $table->foreign('shipping_id')->references('id')->on('shippings')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
