<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->double('price');
            $table->integer('count')->default(0);
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->integer('visible')->default(1);
            $table->boolean('is_for_specialist')->default(false);
            $table->foreignId('promotion_id')->nullable()->constrained('promotions');
            $table->foreignId('discount_id')->nullable()->constrained('discounts');
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
        Schema::drop('products');
    }
}
