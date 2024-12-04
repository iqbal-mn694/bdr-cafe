<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('code');
            $table->string('status');
            $table->string('approved_by')->nullable();
            $table->string('approved_at')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->date('cancelled_at')->nullable();
            $table->string('cancellation_note')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->double('grand_total');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('payment');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
