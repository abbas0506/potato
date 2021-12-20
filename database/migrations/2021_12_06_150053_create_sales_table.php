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
            $table->unsignedFloat('grossweight');
            $table->unsignedFloat('carriageperbori');
            $table->unsignedFloat('carriagepertora');
            $table->unsignedFloat('commissionperbori');
            $table->unsignedFloat('commissionpertora');
            $table->unsignedFloat('saleprice');

            //additional costs in case of sale from store
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedFloat('selectorcost')->nullable();
            $table->unsignedFloat('sortingcost')->nullable();
            $table->unsignedFloat('bagpriceperbori');
            $table->unsignedFloat('bagpricepertora');
            $table->unsignedFloat('packingcostperbori')->nullable();
            $table->unsignedFloat('packingcostpertora')->nullable();
            $table->unsignedFloat('loadingcostperbori')->nullable();
            $table->unsignedFloat('loadingcostpertora')->nullable();
            $table->unsignedFloat('randomcost')->nullable();
            $table->date('dateon');

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

            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
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