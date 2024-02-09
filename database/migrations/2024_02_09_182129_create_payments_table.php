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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bid_id');
            $table->decimal('amount', 10, 2);
            $table->string('status'); // 'pending', 'completed', 'failed', etc.
            $table->string('payment_method'); // 'credit_card', 'paypal', etc.
            $table->timestamps();

            $table->foreign('bid_id')->references('id')->on('bids')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
