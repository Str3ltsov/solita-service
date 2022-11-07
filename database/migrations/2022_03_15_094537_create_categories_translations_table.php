<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_translations', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');

            $table->text('description');

            $table->unique(['category_id','locale']);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->string('name');
//            $table->text('description');
//            $table->unsignedBigInteger('parent_id')->unsigned()->nullable();
//            $table->boolean('visible')->default(true);
//            $table->timestamps();
//            $table->foreign('parent_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories_translations');
    }
}
