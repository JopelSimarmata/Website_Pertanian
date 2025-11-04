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
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id('reply_id');
            $table->unsignedBigInteger('thread_id')->index();
            $table->unsignedBigInteger('author_id')->index();
            $table->text('content');
            $table->unsignedInteger('likes_count')->default(0);
            $table->boolean('is_solution')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_replies');
    }
};
