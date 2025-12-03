<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $rooms = DB::table('rooms')->pluck('room_id')->toArray();
        DB::table('bookings')->insert([
            [
                'booking_id' => 'ABC1234',
                'user_id' => $users[0],
                'room_id' => $rooms[0],
                'check_in_date' => '2025-01-10',
                'check_out_date' => '2025-01-15',
                'guest_count' => 2,
                'booking_status' => 'confirmed',
            ],
            [
                'booking_id' => 'A445',
                'user_id' => $users[1],
                'room_id' => $rooms[1],
                'check_in_date' => '2025-02-01',
                'check_out_date' => '2025-02-05',
                'guest_count' => 1,
                'booking_status' => 'pending',
            ],
        ]);
    }
}
