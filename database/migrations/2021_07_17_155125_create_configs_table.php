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
            $table->unsignedFloat('reduction0');
            $table->unsignedFloat('reduction1');
            $table->unsignedFloat('commission0');
            $table->unsignedFloat('commission1');
            $table->unsignedFloat('bagprice0');
            $table->unsignedFloat('bagprice1');
            $table->unsignedFloat('packing0');
            $table->unsignedFloat('packing1');
            $table->unsignedFloat('loading0');
            $table->unsignedFloat('loading1');
            $table->unsignedFloat('carriage0');
            $table->unsignedFloat('carriage1');
            $table->unsignedFloat('storage0');
            $table->unsignedFloat('storage1');
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