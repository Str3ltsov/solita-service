<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('id');
            $table->unsignedBigInteger('cart_id')->unsigned();
            $table->integer('order_id')->default(0);
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('admin_id')->unsigned();
            $table->unsignedBigInteger('status_id')->unsigned();
            $table->double('sum')->nullable();
            $table->timestamps();
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
