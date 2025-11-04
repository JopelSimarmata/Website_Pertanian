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
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->id('thread_id');
            $table->unsignedBigInteger('author_id')->index();
            $table->string('title');
            $table->text('content');
            $table->json('tags')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('replies_count')->default(0);
            $table->boolean('is_pinned')->default(false)->index();
            $table->boolean('is_solved')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_threads');
    }
};
