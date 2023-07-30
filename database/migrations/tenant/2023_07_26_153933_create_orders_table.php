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
            $table->uuid('id')->primary();
            $table->integer('order_number');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_address_province');
            $table->string('customer_address_city');
            $table->string('customer_address_area');
            $table->string('customer_address_nearby_landmark')->nullable();
            $table->decimal('total_price');
            $table->decimal('total_discount')->nullable();
            $table->integer('total_quantity');
            $table->string('order_note')->nullable();
            $table->string('payment_method')->default('cod');
            $table->decimal('delivery_charge')->default(0);
            $table->string('payment_status')->default('unpaid');
            $table->string('order_status')->default('pending');
            $table->json('products');
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
