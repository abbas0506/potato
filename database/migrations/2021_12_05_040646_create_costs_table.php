<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedFloat('commission0');
            $table->unsignedFloat('commission1');
            $table->unsignedInteger('selector');
            $table->unsignedInteger('sorting');

            $table->unsignedFloat('bagprice0');
            $table->unsignedFloat('bagprice1');
            $table->unsignedFloat('packing0');
            $table->unsignedFloat('packing1');
            $table->unsignedInteger('loading0');
            $table->unsignedInteger('loading1');
            $table->unsignedInteger('carriage0');
            $table->unsignedInteger('carriage1');
            $table->unsignedInteger('storage0')->nullable();
            $table->unsignedInteger('storage1')->nullable();

            $table->unsignedInteger('sadqa');
            $table->unsignedInteger('random');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('costs');
    }
}