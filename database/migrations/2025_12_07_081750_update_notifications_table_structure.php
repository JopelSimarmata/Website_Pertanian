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
        Schema::table('notifications', function (Blueprint $table) {
            // Drop old columns if they exist
            if (Schema::hasColumn('notifications', 'message')) {
                $table->dropColumn('message');
            }
            if (Schema::hasColumn('notifications', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('notifications', 'reference_id')) {
                $table->dropColumn('reference_id');
            }
            
            // Add new data column if it doesn't exist
            if (!Schema::hasColumn('notifications', 'data')) {
                $table->json('data')->nullable()->after('type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Restore old columns
            $table->text('message')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable()->index();
            
            // Drop data column
            if (Schema::hasColumn('notifications', 'data')) {
                $table->dropColumn('data');
            }
        });
    }
};
