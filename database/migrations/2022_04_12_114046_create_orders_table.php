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
            $table->id();
            $table->integer('order_id')->default(0);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('employee_id')->constrained('users');
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->string('name');
            $table->string('description')->nullable();
            $table->double('budget');
            $table->integer('total_hours');
            $table->integer('complete_hours')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('generated_com_offer')->default(false);
            $table->timestamps();

            // oprosnik vse voprosy ( 5 )

            //name
            // desc

            // biudzhet v chasah
            // biudzhet v dengah
            //data nachala
            // data konca

            //order - specialist tablica ( mnogo k mnogo ) order_id specialist_id hours
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
