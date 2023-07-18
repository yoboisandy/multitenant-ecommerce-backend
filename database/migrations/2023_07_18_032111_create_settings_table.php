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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('store_id')->constrained('stores');
            $table->string('store_fb')->nullable();
            $table->string('store_ig')->nullable();
            $table->string('store_tiktok')->nullable();
            $table->string('store_whatsapp')->nullable();
            $table->decimal('delivery_charge')->nullable();
            $table->string('delivery_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
