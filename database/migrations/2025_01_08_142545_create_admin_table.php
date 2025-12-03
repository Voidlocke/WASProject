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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('admin_id'); // Primary Key
            $table->string('admin_name');
            $table->string('admin_email')->unique();
            $table->string('admin_pass');
            $table->string('booking_id'); // Foreign Key (match data type with 'booking_id' in 'booking' table)
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
