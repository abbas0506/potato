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
            $table->unsignedInteger('grossweight');
            $table->unsignedInteger('purchasepriceperkg');
            $table->unsignedInteger('commissionperbori');
            $table->unsignedInteger('commissionpertora');
            //additional costs on product collection
            $table->unsignedInteger('selectorcost');
            $table->unsignedInteger('sortingcost');
            $table->unsignedInteger('materialcostperbori');
            $table->unsignedInteger('materialcostpertora');
            $table->unsignedInteger('packingcostperbori');
            $table->unsignedInteger('packingcostpertora');
            $table->unsignedInteger('loadingcostperbori');
            $table->unsignedInteger('loadingcostpertora');
            $table->unsignedInteger('randomcost');
            $table->date('dateon');

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