<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->longText('address');
            $table->double('phone');
            $table->string('order_track');
            $table->integer('payment_id')->nullable();
            $table->date('order_date')->nullable();
            $table->date('shipping_date')->nullable();
//            $table->integer('shipper_id')->nullable();
            $table->string('subtotal');
            $table->string('sales_tax')->nullable();
            $table->integer('shipping_id')->unsigned();
            $table->integer('coupon_id')->nullable();
            $table->integer('discount')->nullable()->default('0');
            $table->string('final_total');
            $table->boolean('paid')->default(0);
            $table->boolean('delivered')->default(0);
            $table->date('payment_date')->nullable();
            $table->boolean('status')->default(0);
            $table->foreign('customer_id')->references('id')->on('users')->ondelete('cascade');
//            $table->foreign('address_id')->references('id')->on('address')->ondelete('cascade');
            $table->foreign('shipping_id')->references('id')->on('shippings')->ondelete('cascade');
//            $table->foreign('coupon_id')->references('id')->on('coupons')->ondelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
