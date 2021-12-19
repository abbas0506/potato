<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedInteger('numofbori');
            $table->unsignedInteger('numoftora');
            $table->unsignedInteger('storagecostperbori');
            $table->unsignedInteger('storagecostpertora');
            $table->unsignedInteger('carriageperbori');
            $table->unsignedInteger('carriagepertora');
            $table->string('note', 200)->nullable(); //room detail etc
            $table->date('dateon');

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases')
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
        Schema::dropIfExists('storages');
    }
}