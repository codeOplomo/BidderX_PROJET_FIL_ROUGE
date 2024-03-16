<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('condition');
            $table->string('manufacturer');
            $table->integer('production_year')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id'); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Add this line
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
};
