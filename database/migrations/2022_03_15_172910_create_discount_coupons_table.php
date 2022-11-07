<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCouponsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id('id');
            $table->string('code');
            $table->integer('used');
            $table->double('value');
            $table->unsignedBigInteger("user_id")->nullable(true);
            $table->integer('cart_id')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
//            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discount_coupons');
    }
}
