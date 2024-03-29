<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('starting_bid_price', 10, 2);
            $table->decimal('current_bid_price', 10, 2)->nullable();
            $table->boolean('is_instant')->default(false);
            $table->string('motif')->nullable();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    public function down()
    {
        Schema::dropIfExists('auctions');
    }
};
