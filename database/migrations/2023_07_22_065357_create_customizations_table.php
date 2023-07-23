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
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('store_id')->constrained('stores');
            $table->string('theme')->default('Default');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('selected_hero')->default('Default');
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_url')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('selected_navbar')->default('Default');
            $table->string('topbar_text')->nullable();
            $table->string('topbar_url')->nullable();
            $table->string('ad1_image')->nullable();
            $table->string('ad1_url')->nullable();
            $table->string('ad2_image')->nullable();
            $table->string('ad2_url')->nullable();
            $table->text('youtube_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
