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
//            $table->foreignId('cart_id')->constrained('carts');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('specialist_id')->constrained('users');
            $table->foreignId('employee_id')->constrained('users');
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->integer('delivery_time')->default(3)->nullable();
            $table->double('sum')->nullable(); // suma okonchatelnaja - rabotnika
            $table->integer('total_hours')->nullable(); // suma okonchatelnaja - rabotnika
            $table->integer('complete_hours')->nullable();
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
