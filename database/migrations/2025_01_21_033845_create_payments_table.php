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
            $table->increments('id');
            $table->unsignedInteger('booking_id');
            $table->decimal('amount', 10, 2);
            $table->string('payment_proof')->nullable(); // Path to the uploaded payment image
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending'); // Payment status
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
