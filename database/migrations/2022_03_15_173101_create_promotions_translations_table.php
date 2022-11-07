<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTranslationsTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
    public function up()
    {
        Schema::create('promotions_translations', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('promotion_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');

            $table->text('description');

            $table->unique(['promotion_id','locale']);

            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promotions_translations');
    }
}
