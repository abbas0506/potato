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
            $table->unsignedFloat('reductionperbori');
            $table->unsignedFloat('reductionpertora');
            $table->unsignedFloat('commissionperbori');
            $table->unsignedFloat('commissionpertora');
            //additional costs on product collection
            $table->unsignedFloat('selectorcost');
            $table->unsignedFloat('sortingcost');
            $table->unsignedFloat('bagpriceperbori');
            $table->unsignedFloat('bagpricepertora');
            $table->unsignedFloat('packingcostperbori');
            $table->unsignedFloat('packingcostpertora');
            $table->unsignedFloat('loadingcostperbori');
            $table->unsignedFloat('loadingcostpertora');
            $table->unsignedInteger('randomcost');
            $table->string('randomnote')->nullable();
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