<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_id');
            $table->unsignedBigInteger('transporter_id');
            $table->string('vehicleno', 20);
            $table->unsignedInteger('numofbori');
            $table->unsignedInteger('numoftora');
            $table->unsignedFloat('grossweight');
            $table->unsignedFloat('priceperkg');
            $table->unsignedFloat('reduction0');
            $table->unsignedFloat('reduction1');
            $table->unsignedBigInteger('cost_id');

            $table->foreign('deal_id')
                ->references('id')
                ->on('deals')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('transporter_id')
                ->references('id')
                ->on('transporters')
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
        Schema::dropIfExists('purchases');
    }
}