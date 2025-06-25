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
        Schema::create('ntdd_brand', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 1000)->nullable(false);
            $table->string('slug', 1000)->nullable(false);
            $table->string('image', 1000)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->tinyInteger('status', false, true)->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ntdd_brand');
    }
};
