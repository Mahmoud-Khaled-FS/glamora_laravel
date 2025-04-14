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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->text('summary_ar');
            $table->text('summary_en');
            $table->string('image');
            $table->foreignId('category_id')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('price');
            $table->integer('quantity')->nullable();
            $table->integer('discount')->default(0);
            $table->float('rating')->default(0);
            $table->foreignId('store_id')->nullable();

            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
