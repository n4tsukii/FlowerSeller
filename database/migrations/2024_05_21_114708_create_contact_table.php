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
        Schema::create('ntdd_contact', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();  
            $table->string('name', 255);  
            $table->string('email', 255); 
            $table->string('phone', 255);  
            $table->string('title', 255); 
            $table->mediumText('content');  
            $table->unsignedInteger('reply_id')->default(0);  
            $table->dateTime('created_at')->notNullable();  
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
        Schema::dropIfExists('ntdd_contact');
    }
};
