<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            ['room_id' => '01','type' => 'Suite Room', 'prices' => 120.00, 'maxperson' => 3, 'bed' => 1, 'availability' => true],
           ['room_id' => '02','type' => 'Family Room', 'prices' => 200.00, 'maxperson' => 4, 'bed' => 2, 'availability' => true],
          ['room_id' => '03','type' => 'Deluxe Room', 'prices' => 150.00, 'maxperson' => 3, 'bed' => 2, 'availability' => true],
            ['room_id' => '04','type' => 'Classic Room', 'prices' => 130.00, 'maxperson' => 4, 'bed' => 2, 'availability' => true],
            ['room_id' => '05','type' => 'Superior Room', 'prices' => 300.00, 'maxperson' => 6, 'bed' => 3, 'availability' => true],
            ['room_id' => '06','type' => 'Luxury Room', 'prices' => 500.00, 'maxperson' => 2, 'bed' => 1, 'availability' => true],
        ]);
    }
}
