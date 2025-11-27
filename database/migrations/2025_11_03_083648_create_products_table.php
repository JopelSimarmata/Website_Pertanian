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
            $table->id('product_id');
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('seller_id')->index();
            $table->string('name', 255)->index();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price')->default(0); 
            $table->unsignedInteger('stock')->default(0); 
            $table->string('unit', 50)->nullable(); 
            $table->decimal('rating', 3, 2)->default(0.00); 
            $table->unsignedInteger('reviews_count')->default(0); 
            $table->boolean('is_active')->default(true);
            $table->string('location', 255)->nullable(); 
            $table->text('detail_address')->nullable(); 
            $table->string('farmer_email', 255)->nullable()->index(); 
            $table->string('farmer_phone', 25)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
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
