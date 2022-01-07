<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('cost_id');

            $table->unsignedInteger('numofbori');
            $table->unsignedInteger('numoftora');
            $table->unsignedDouble('grossweight');
            $table->unsignedFloat('reduction0');
            $table->unsignedFloat('reduction1');
            $table->unsignedDouble('saleprice', 15, 5);

            $table->date('dateon');

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('buyer_id')
                ->references('id')
                ->on('buyers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('cost_id')
                ->references('id')
                ->on('costs')
                ->onUpdate('cascade')
                ->onDelete('cascade');


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
        Schema::dropIfExists('sales');
    }
}