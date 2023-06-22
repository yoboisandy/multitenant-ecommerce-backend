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
        Schema::create('variant_options', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('variant_id')->constrained('variants')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('selling_price');
            $table->decimal('cost_price');
            $table->decimal('crossed_price')->nullable();
            $table->integer('quantity');
            $table->string('sku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_options');
    }
};
