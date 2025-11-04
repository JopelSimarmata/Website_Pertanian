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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('buyer_id')->index();
            $table->unsignedBigInteger('request_id')->index();
            $table->unsignedBigInteger('amount');
            $table->string('payment_method', 100);
            $table->string('status', 50)->default('pending');
            $table->string('sender_name');
            $table->string('sender_account', 100);
            $table->string('payment_proof_url', 2048)->nullable();
            $table->text('payment_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
