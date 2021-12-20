<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedFloat('weightreductionperbori');
            $table->unsignedFloat('weightreductionpertora');
            $table->unsignedFloat('commissionperbori');
            $table->unsignedFloat('commissionpertora');
            $table->unsignedFloat('materialcostperbori');
            $table->unsignedFloat('materialcostpertora');
            $table->unsignedFloat('packingcostperbori');
            $table->unsignedFloat('packingcostpertora');
            $table->unsignedFloat('loadingcostperbori');
            $table->unsignedFloat('loadingcostpertora');
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
        Schema::dropIfExists('configs');
    }
}