<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $name = DB::table('users')->pluck('name')->toArray();
        DB::table('reviews')->insert([
            [
                'review_id' => 'rev12',
                'user_id' => $users[0],
                'user_name' => $name [0],
                'rating' => 5.0,
                'review_text' => 'Great room and service!',
                'review_date' => '2025-01-20',
            ],
            [
                'review_id' => 'rev123',
                'user_id' => $users[1],
                'user_name' => $name[1],
                'rating' => 4.5,
                'review_text' => 'Comfortable stay.',
                'review_date' => '2025-02-06',
            ],
        ]);
    }
}
