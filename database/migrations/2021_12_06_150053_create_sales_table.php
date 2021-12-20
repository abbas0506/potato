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
            $table->unsignedInteger('carriageperbori');
            $table->unsignedInteger('carriagepertora');
            $table->unsignedInteger('commissionperbori');
            $table->unsignedInteger('commissionpertora');
            $table->unsignedInteger('saleprice');

            //additional costs in case of sale from store
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedInteger('selectorcost')->nullable();
            $table->unsignedInteger('sortingcost')->nullable();
            $table->unsignedInteger('materialcostperbori');
            $table->unsignedInteger('materialcostpertora');
            $table->unsignedInteger('packingcostperbori')->nullable();
            $table->unsignedInteger('packingcostpertora')->nullable();
            $table->unsignedInteger('loadingcostperbori')->nullable();
            $table->unsignedInteger('loadingcostpertora')->nullable();
            $table->unsignedInteger('randomcost')->nullable();
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
