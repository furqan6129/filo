<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
      $table->id();

			$table->enum('type',['pet', 'phone', 'jewellery'])->default('pet');
			$table->string('colour', 12);
			$table->string('description', 256)->nullable();
			$table->string('image', 256)->nullable();
			$table->string('location', 20);
      $table->unsignedBigInteger('addedBy');
			$table->foreign('addedBy')->references('id')->on('users');
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
        Schema::dropIfExists('items');
    }
}
