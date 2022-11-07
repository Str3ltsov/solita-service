<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id');
            $table->string('subject');
            $table->text('message_text');
            $table->unsignedBigInteger('user_from')->unsigned();
            $table->unsignedBigInteger('user_to')->unsigned();
            $table->unsignedBigInteger('cart_id')->unsigned()->nullable(true);
            $table->unsignedBigInteger('order_id')->unsigned()->nullable(true);
            $table->unsignedBigInteger('return_id')->unsigned()->nullable(true);

            $table->foreign('user_from')->references('id')->on('users');
            $table->foreign('user_to')->references('id')->on('users');
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('return_id')->references('id')->on('returns');

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
        Schema::drop('messages');
    }
}
