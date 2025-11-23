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
        Schema::create('visit_requests', function (Blueprint $table) {
            $table->id('request_id');
            $table->unsignedBigInteger('buyer_id')->index();
            $table->unsignedBigInteger('seller_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->date('visit_date');
            $table->time('visit_time');
             $table->unsignedInteger('quantity')->default(1);
            $table->string('status', 50)->default('pending')->index();
            $table->text('notes')->nullable();
            $table->text('rejection_reason')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_requests');
    }
};
