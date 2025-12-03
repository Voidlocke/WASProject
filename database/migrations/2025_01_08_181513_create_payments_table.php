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
            $table->id('payment_id'); // Primary key
            $table->string('booking_id');  // Foreign key
            $table->double('amount', 10, 2); // Amount with precision
            $table->string('card_name', 30);
            $table->integer('card_number'); // Card number as integer
            $table->string('expiry_date', 302); // Expiry date as date
            $table->integer('ccv'); // CCV as integer2
            $table->enum('payment_status', ['success', 'fail']); // Status
            $table->timestamps();

            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
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
