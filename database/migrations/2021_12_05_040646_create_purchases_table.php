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

            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('purchase_numofbori');
            $table->unsignedInteger('purchase_numoftora');
            $table->unsignedInteger('purchase_grossweight');
            $table->unsignedInteger('purchase_actualweight');
            $table->unsignedInteger('purchase_price');
            $table->unsignedInteger('purchase_commission');
            $table->unsignedInteger('purchase_bagscost');
            $table->unsignedInteger('purchase_selectorcost');
            $table->unsignedInteger('purchase_packingcost');
            $table->unsignedInteger('purchase_loadingcost');

            $table->foreign('seller_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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