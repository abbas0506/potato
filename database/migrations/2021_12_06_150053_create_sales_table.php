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
            $table->unsignedBigInteger('client_id');
            $table->unsignedInteger('numofbori');
            $table->unsignedInteger('numoftora');
            $table->unsignedInteger('grossweight');
            $table->unsignedInteger('saleprice');
            $table->unsignedInteger('commission');
            $table->unsignedBigInteger('transporter_id');
            $table->string('vehicleno', 20);
            $table->unsignedInteger('carriage');

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('transporter_id')
                ->references('id')
                ->on('transporters')
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