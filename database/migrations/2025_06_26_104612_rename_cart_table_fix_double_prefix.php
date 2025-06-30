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
        // Rename the double-prefixed table to the correct name
        if (Schema::hasTable('ntdd_cart')) {
            // Table exists with single prefix, we're good
            return;
        }
        
        if (Schema::hasTable('ntdd_ntdd_cart')) {
            // Table has double prefix, rename it
            Schema::rename('ntdd_ntdd_cart', 'cart');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the rename if needed
        if (Schema::hasTable('cart')) {
            Schema::rename('cart', 'ntdd_ntdd_cart');
        }
    }
};
