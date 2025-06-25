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
        Schema::create('ntdd_category', function (Blueprint $table) {
            $table->id(); 
            $table->string('name', 1000)->notNullable(); 
            $table->string('slug', 1000)->notNullable(); 
            $table->string('image', 1000)->nullable(); 
            $table->unsignedInteger('parent_id')->default(0); 
            $table->unsignedInteger('sort_order')->default(1);
            $table->string('description', 255)->nullable(); 
            $table->dateTime('created_at')->notNullable(); 
            $table->unsignedInteger('created_by')->notNullable(); 
            $table->dateTime('updated_at')->nullable(); 
            $table->unsignedInteger('updated_by')->nullable(); 
            $table->unsignedTinyInteger('status')->default(2); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ntdd_category');
    }
};
