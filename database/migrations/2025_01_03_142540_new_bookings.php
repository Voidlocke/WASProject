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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('booking_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('room_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('guest_count')->default(1);
            $table->string('booking_status')->default('pending');
            $table->timestamps(); // Adds created_at and updated_at columns

            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
