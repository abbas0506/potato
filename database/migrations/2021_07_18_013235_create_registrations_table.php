<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateRegistrationsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('registrations', function (Blueprint $table) {
         $table->id();
         $table->string('name', 50);
         $table->string('phone', 20);
         $table->date('dob');
         $table->string('bform', 16);
         $table->unsignedBigInteger('bise_id');
         $table->unsignedInteger('passyear');
         $table->unsignedInteger('rollno');
         $table->unsignedInteger('marks');
         $table->unsignedInteger('concession')->default(0);
         $table->unsignedBigInteger('group_id');
         $table->string('image')->nullable();
         $table->string('bloodgroup', 5)->nullable();
         $table->string('speciality', 50)->nullable();
         $table->string('address', 100)->nullable();

         $table->unsignedInteger('distance')->nullable();
         $table->unsignedBigInteger('preschool_id')->nullable();
         $table->string('fname', 50)->nullable();
         $table->string('fcnic', 16)->nullable();
         $table->string('mname', 50)->nullable();
         $table->string('mcnic', 16)->nullable();
         $table->string('grelation', 10)->nullable();
         $table->string('gname', 50)->nullable();
         $table->string('gcnic', 16)->nullable();
         $table->string('profession', 50)->nullable();
         $table->unsignedInteger('income')->nullable();

         $table->boolean('haspics')->default(0);
         $table->boolean('hasgcnic')->default(0);
         $table->boolean('hasbform')->default(0);
         $table->boolean('hasmatric')->default(0);
         $table->boolean('hasnoc')->default(0);
         $table->boolean('isdobcorrect')->default(0);
         $table->boolean('isbformcorrect')->default(0);
         $table->boolean('ismarkscorrect')->default(0);

         $table->date('paidat')->nullable();
         $table->date('createdat')->nullable();
         $table->unsignedInteger('admno')->nullable();
         $table->unsignedInteger('classrollno')->nullable();
         $table->unsignedBigInteger('section_id')->nullable();

         $table->foreign('group_id')
            ->references('id')
            ->on('groups')
            ->onUpdate('cascade')
            ->onDelete('cascade');

         $table->foreign('section_id')
            ->references('id')
            ->on('sections')
            ->onUpdate('cascade')
            ->onDelete('cascade');

         $table->foreign('bise_id')
            ->references('id')
            ->on('bises')
            ->onUpdate('cascade')
            ->onDelete('cascade');

         $table->foreign('preschool_id')
            ->references('id')
            ->on('preschools')
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
      Schema::dropIfExists('registrations');
   }
}