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
        Schema::create('ntdd_user', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 255);
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('address', 255);
            $table->string('image', 255);
            $table->enum('roles', ['admin', 'customer'])->default('customer');;
            $table->dateTime('created_at')->useCurrent();
            $table->unsignedInteger('created_by');
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(1); // Changed from 2 to 1 (active by default)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ntdd_user');
    }
};
