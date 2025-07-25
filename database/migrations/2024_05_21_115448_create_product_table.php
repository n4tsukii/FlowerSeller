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
        Schema::create('ntdd_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->string('name', 1000);
            $table->string('slug', 1000);
            $table->float('price', 8, 2);
            $table->float('pricesale', 8, 2)->nullable();
            $table->string('image', 1000);
            $table->unsignedInteger('qty');
            $table->mediumText('detail');
            $table->string('description', 255)->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->unsignedInteger('created_by');
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ntdd_product');
    }
};
