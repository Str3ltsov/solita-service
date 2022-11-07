<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts_translations', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('discount_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');

            $table->text('description');

            $table->unique(['discount_id','locale']);

            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discounts_translations');
    }
}
