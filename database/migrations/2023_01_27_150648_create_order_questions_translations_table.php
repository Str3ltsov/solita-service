<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderQuestionsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_questions_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_question_id')
                ->constrained('order_questions')
                ->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('question');
            $table->unique(['order_question_id','locale']);
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
        Schema::dropIfExists('order_questions_translations');
    }
}
