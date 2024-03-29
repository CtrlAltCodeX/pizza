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
            $table->id();
            $table->string('order_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('country_code');
            $table->string('state');
            $table->string('city');
            $table->string('zip');
            $table->string('payment_method');
            $table->string('total');
            $table->timestamps();
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
